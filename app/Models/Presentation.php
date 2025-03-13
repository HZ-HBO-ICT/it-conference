<?php

namespace App\Models;

use App\Actions\Log\ApprovalHandler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Company|null $company
 * @property-read mixed $creator
 * @property-read \App\Models\Difficulty|null $difficulty
 * @property-read mixed $duration
 * @property-read mixed $is_scheduled
 * @property-read mixed $participants
 * @property-read mixed $remaining_capacity
 * @property-read \App\Models\Room|null $room
 * @property-read mixed $speakers
 * @property-read mixed $speakers_name
 * @property-read \App\Models\Timeslot|null $timeslot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserPresentation> $userPresentations
 * @property-read int|null $user_presentations_count
 * @method static \Database\Factories\PresentationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presentation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presentation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Presentation query()
 * @mixin \Eloquent
 */
class Presentation extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['name', 'max_participants', 'description', 'type', 'difficulty_id', 'file_path',
        'company_id', 'room_id', 'timeslot_id', 'start', 'is_approved'];

    /**
     * Returns the basic validation rules for the model
     * @return string[]
     */
    public static function rules()
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'max_participants' => 'required|numeric|min:1|max:999',
            'description' => 'required|string|min:1|max:300',
            'type' => 'required|in:workshop,lecture',
            'difficulty_id' => 'required|numeric|exists:difficulties,id',
        ];
    }

    /**
     * Returns the duration of the lecture based on the Edition
     *
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public static function lectureDuration()
    {
        return Edition::current()->lecture_duration;
    }

    /**
     * Returns the duration of the workshops based on the Edition
     *
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public static function workshopDuration()
    {
        return Edition::current()->workshop_duration;
    }

    /**
     * Establishes a relationship between the presentation
     * and its difficulty
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    /**
     * Establishes a relationship between the presentation and
     * the timeslot it's assigned to
     * @return BelongsTo
     */
    public function timeslot(): BelongsTo
    {
        return $this->belongsTo(Timeslot::class);
    }

    /**
     * Establishes a relationship between the presentation and
     * the room it's assigned to
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Establishes a relationship between the presentations and the company
     * NOTE: Not all the presentations have a company (there are independent speakers)
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Hides a many-to-many relationship with users
     * and implements relationship with linking table UserPresentation
     * @return HasMany
     */
    public function userPresentations(): HasMany
    {
        return $this->hasMany(UserPresentation::class);
    }

    /**
     * Settings for the log system for this model
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn(string $eventName) => "Presentation {$this->name} has been {$eventName} by " . Auth::user()->name)
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(['is_approved']);
    }

    /**
     * Retrieves all users that have enrolled in the presentation as participants
     * @return Attribute
     */
    public function participants(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('userPresentations', function ($query) {
                $query->where('presentation_id', $this->id)
                    ->where('role', 'participant');
            })->get(),
        );
    }

    /**
     * Retrieves all the speakers of the presentation
     * @return Attribute
     */
    public function speakers(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('userPresentations', function ($query) {
                $query->where('presentation_id', $this->id)
                    ->where('role', 'speaker');
            })->get(),
        );
    }

    /**
     * Returns a speaker of the presentation that was registered first,
     * and therefore had most likely created the presentation
     *
     * @return Attribute
     */
    public function creator(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('userPresentations', function ($query) {
                $query->where('presentation_id', $this->id)
                    ->where('role', 'speaker');
            })->orderBy('created_at')
                ->first()
        );
    }

    /**
     * Definition of the `remaining_capacity` attribute that shows the amount
     * of participants that currently can enroll the presentation
     *
     * @return Attribute
     */
    public function remainingCapacity(): Attribute
    {
        return Attribute::make(
            get: fn() => min($this->room->max_participants, $this->max_participants) - $this->participants->count(),
        );
    }

    /**
     * Determine if the presentation that the user wants to enroll for
     * doesn't have any scheduling conflicts
     *
     * @param User $user
     * @return bool
     */
    public function noConflicts(User $user): bool
    {
        $presentationStart = Carbon::parse($this->start);
        $presentationEnd = Carbon::parse($this->start)
            ->copy()
            ->addMinutes($this->duration);

        if ($user->presenter_of) {
            $speakingStart = Carbon::parse($user->presenter_of->start);
            $speakingEnd = Carbon::parse($user->presenter_of->start)
                ->copy()
                ->addMinutes($user->presenter_of->duration);

            if ($presentationEnd > $speakingStart && $presentationStart < $speakingEnd) {
                return false;
            }
        }

        foreach ($user->participating_in as $enrolledPresentation) {
            $enrolledStart = Carbon::parse($enrolledPresentation->start);
            $enrolledEnd = Carbon::parse($enrolledPresentation->start)
                ->copy()
                ->addMinutes($enrolledPresentation->duration);

            if ($presentationEnd > $enrolledStart && $presentationStart < $enrolledEnd) {
                return false;
            }
        }

        return true;
    }

    /**
     * Handle a (dis)approval of this Presentation.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleApproval(bool $isApproved): void
    {
        (new ApprovalHandler())->execute($this, $isApproved);
    }

    /**
     * Returns the speakers' names in a string
     * @return Attribute
     */
    public function speakersName(): Attribute
    {
        return Attribute::make(
            get: fn() => implode(', ', $this->speakers->pluck('name')->toArray())
        );
    }

    /**
     * Returns the duration of the presentation based on the type
     * @return Attribute
     */
    public function duration(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->type == 'workshop'
                ? Presentation::workshopDuration()
                : Presentation::lectureDuration()
        );
    }

    /**
     * Returns the display name for the presentation (useful in the scheduler)
     *
     * @param $maxLength
     * @return string
     */
    public function displayName($maxLength)
    {
        $name = $this->name;

        if ($this->company
            && $this->company->sponsorship
            && $this->company->is_sponsorship_approved) {
            $name = Sponsorship::icons()[$this->company->sponsorship_id] . $name;
        }

        return strlen($name) > $maxLength
            ? substr($name, 0, $maxLength)
            . '...' : $name;
    }

    /**
     * Checks if the presentation has start, room and timeslot
     *
     * @return Attribute
     */
    public function isScheduled(): Attribute
    {
        return Attribute::make(
            get: fn() => !is_null($this->start) && !is_null($this->room_id) && !is_null($this->timeslot_id)
        );
    }

    /**
     * Determine whether the passed model instance is the same as the calling one
     *
     * @param Presentation $presentation
     * @return bool
     */
    public function isSamePresentation(Presentation $presentation): bool
    {
        return $this->is($presentation) &&
            $this->name == $presentation->name &&
            $this->description == $presentation->description &&
            $this->type == $presentation->type &&
            $this->max_participants == $presentation->max_participants &&
            $this->difficulty->id == $presentation->difficulty->id;
    }
}

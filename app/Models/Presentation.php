<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\PresentationFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Presentation
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $max_participants The max number of participants that the presenter allows
 * @property string $type
 * @property int|null $timeslot_id
 * @property int|null $room_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $difficulty_id
 * @property-read Difficulty|null $difficulty
 * @property-read Collection<int, User> $participants
 * @property-read int|null $participants_count
 * @property-read Room|null $room
 * @property-read Collection<int, Speaker> $speakers
 * @property-read int|null $speakers_count
 * @property-read Timeslot|null $timeslot
 * @method static PresentationFactory factory($count = null, $state = [])
 * @method static Builder|Presentation newModelQuery()
 * @method static Builder|Presentation newQuery()
 * @method static Builder|Presentation query()
 * @method static Builder|Presentation whereCreatedAt($value)
 * @method static Builder|Presentation whereDescription($value)
 * @method static Builder|Presentation whereDifficultyId($value)
 * @method static Builder|Presentation whereId($value)
 * @method static Builder|Presentation whereMaxParticipants($value)
 * @method static Builder|Presentation whereName($value)
 * @method static Builder|Presentation whereRoomId($value)
 * @method static Builder|Presentation whereTimeslotId($value)
 * @method static Builder|Presentation whereType($value)
 * @method static Builder|Presentation whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Presentation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'max_participants', 'description', 'type', 'difficulty_id', 'file_path'];

    public static function rules()
    {
        return [
            'name' => 'required',
            'max_participants' => 'required|numeric|min:1',
            'description' => 'required',
            'type' => 'required|in:workshop,lecture',
            'difficulty_id' => 'required',
        ];
    }

    /**
     * The room that the presentation is in
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * The timeslot that the presentation is in
     * @return BelongsTo
     */
    public function timeslot(): BelongsTo
    {
        return $this->belongsTo(Timeslot::class);
    }

    /**
     * All participants that signed up for the presentation
     * @return BelongsToMany
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participants', 'presentation_id', 'user_id');
    }

    /**
     * All speakers for the presentation
     * @return HasMany
     */
    public function speakers(): HasMany
    {
        return $this->hasMany(Speaker::class);
    }

    /**
     * The difficulty of the presentation
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    // TODO: Refactor with accessor to return the actual user
    public function mainSpeaker()
    {
        return $this->speakers()->where('is_main_speaker', 1)->first();
    }

    /**
     * Returns a comma separated list of all the speaker names for this presentation.
     *
     * @return Attribute
     */
    public function speakernames(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->speakers->map(fn($item) => $item->user->name)->join(', ')
        );
    }

    /**
     * Checks if the main speaker is approved, therefore if the presentation is approved
     * @return Attribute
     */
    public function isApproved(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->mainSpeaker()->is_approved,
        );
    }

    /**
     * Checks if the presentation is scheduled
     * @return Attribute
     */
    public function isScheduled(): Attribute
    {
        return Attribute::make(
            get: fn() => !is_null($this->timeslot) && !is_null($this->room),
        );
    }

    /**
     * The maximum number of participants for the presentation is determined
     * by the smaller value between the room's capacity and the specified
     * maximum participants for the presentation.
     *
     * @return int
     */
    public function maxParticipants(): int
    {
        return $this->room->max_participants < $this->max_participants
            ? $this->room->max_participants
            : $this->max_participants;
    }

    /**
     * Handle a (dis)approval of this Presentation.
     *
     * @param bool $isApproved
     * @return void
     */
    public function handleApproval(bool $isApproved): void
    {
        if ($isApproved) {
            DB::transaction(function () {
                $this->speakers->each(fn($speaker) => $speaker->approve());
            });
        } else {
            DB::transaction(function () {
                $this->speakers->each(fn($speaker) => $speaker->delete());
                $this->delete();
            });
        }
    }

    /**
     * Scope a query to only include presentations that require approval
     *
     * @param $query
     * @return mixed
     */
    public function scopeAwaitingApproval($query): mixed
    {
        return $query->join('speakers', 'speakers.presentation_id', '=', 'presentations.id')
            ->where('speakers.is_approved', '=', 0);
    }

    /**
     * Deletes the whole presentation, removing all participants and speakers
     *
     * @return void
     */
    public function fullDelete(): void
    {
        $this->participants()->detach();

        $this->speakers->each(function (Speaker $speaker) {
            $speaker->user->removeRole('speaker');
        });
        $this->speakers()->delete();

        $this->delete();
    }

    /**
     * Removes the user from the speakers of this presentation
     *
     * @param User $user
     * @return void
     */
    public function removeSpeaker(User $user): void
    {
        $speaker = $this->speakers->where('user_id', '=', $user->id)->first();

        if ($speaker)
            $speaker->delete();
    }

    /**
     * Checks if the presentation can be deleted
     */
    public function canBeDeleted(): bool
    {
        return !EventInstance::current()->is_final_programme_released;
    }

    public function canEnroll(User $user): bool
    {
        if ($this->maxParticipants() <= $this->participants->count()) {
            return false;
        }
        if ($user->presentations->contains($this)) {
            return false;
        }

        $presentationStart = \Carbon\Carbon::parse($this->timeslot->start);
        $presentationEnd = Carbon::parse($this->timeslot->start)
            ->copy()
            ->addMinutes($this->timeslot->duration);

        if ($user->speaker) {
            $speakerForPresentation = $user->speaker->presentation;

            $speakingStart = Carbon::parse($speakerForPresentation->timeslot->start);
            $speakingEnd = Carbon::parse($speakerForPresentation->timeslot->start)
                ->copy()
                ->addMinutes($speakerForPresentation->timeslot->duration);

            if (!($presentationEnd <= $speakingStart) && !($presentationStart >= $speakingEnd)) {
                return false;
            }
        }

        foreach ($user->presentations as $enrolledPresentation) {
            $enrolledStart = Carbon::parse($enrolledPresentation->timeslot->start);
            $enrolledEnd = Carbon::parse($enrolledPresentation->timeslot->start)
                ->addMinutes($enrolledPresentation->timeslot->duration);

            if (!($presentationEnd <= $enrolledStart) && !($presentationStart >= $enrolledEnd)) {
                return false;
            }
        }

        return true;
    }
}

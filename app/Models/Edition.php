<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * \App\Models\Edition
 *
 * @property int $id
 * @property string $name
 * @property int $state
 * @property Carbon $start_at
 * @property Carbon $end_at
 * @property int $lecture_duration
 * @property int $workshop_duration
 * @property string|null $keynote_name
 * @property string|null $keynote_description
 * @property string|null $keynote_photo_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $configured
 * @property-read mixed $displayed_state
 * @property-read Collection<int, \App\Models\EditionEvent> $editionEvents
 * @property-read int|null $edition_events_count
 * @property-read mixed $is_company_registration_opened
 * @property-read mixed $is_final_programme_released
 * @property-read mixed $is_in_progress
 * @property-read mixed $is_over
 * @property-read mixed $is_participant_registration_opened
 * @property-read mixed $is_requesting_presentation_opened
 * @property-read mixed $keynote_configured
 * @property-read mixed $keynote_picture_source
 * @property-read Collection<int, PresentationType> $presentationTypes
 * @property-read int|null $presentation_types_count
 * @method static Builder<static>|Edition newModelQuery()
 * @method static Builder<static>|Edition newQuery()
 * @method static Builder<static>|Edition query()
 * @method static Builder<static>|Edition whereCreatedAt($value)
 * @method static Builder<static>|Edition whereEndAt($value)
 * @method static Builder<static>|Edition whereId($value)
 * @method static Builder<static>|Edition whereKeynoteDescription($value)
 * @method static Builder<static>|Edition whereKeynoteName($value)
 * @method static Builder<static>|Edition whereKeynotePhotoPath($value)
 * @method static Builder<static>|Edition whereLectureDuration($value)
 * @method static Builder<static>|Edition whereName($value)
 * @method static Builder<static>|Edition whereStartAt($value)
 * @method static Builder<static>|Edition whereState($value)
 * @method static Builder<static>|Edition whereUpdatedAt($value)
 * @method static Builder<static>|Edition whereWorkshopDuration($value)
 * @mixin \Eloquent
 */
class Edition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
        'start_at',
        'end_at',
        'lecture_duration',
        'workshop_duration',
        'keynote_name',
        'keynote_description',
        'keynote_photo_path',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    const STATE_DESIGN = 10;
    const STATE_ANNOUNCE = 20;
    const STATE_ENROLLMENT = 30;
    const STATE_EXECUTION = 40;
    const STATE_ARCHIVE = 50;

    /**
     * Returns basic validation rules for Edition
     * @return string[]
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|unique:editions|max:255',
            'start_at' => 'required|date|after:' . Carbon::now()->addMonth() . '|before:' . Carbon::now()->addYears(2),
            'end_at' => 'required|date|after:start_at|before:' . Carbon::now()->addYears(2)
        ];
    }

    /**
     * Establishes a relationship between Edition and
     * EditionEvent models (events that are executed during given edition)
     *
     * @return HasMany
     */
    public function editionEvents(): HasMany
    {
        return $this->hasMany(EditionEvent::class);
    }

    /**
     * Establishes a relationship between Edition and PresentationTypes
     * @return HasMany<PresentationType, $this>
     */
    public function presentationTypes(): HasMany
    {
        return $this->hasMany(PresentationType::class);
    }

    /**
     * Check if the final programme is released
     *
     * @return Attribute
     */
    protected function isFinalProgrammeReleased(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->state == Edition::STATE_ENROLLMENT
                || $this->state == Edition::STATE_EXECUTION
        );
    }

    /**
     * Check if the company registration is opened
     * @return Attribute
     */
    public function isCompanyRegistrationOpened(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->state == Edition::STATE_ANNOUNCE
                    || $this->state == Edition::STATE_ENROLLMENT)
                && (Carbon::today() >= $this->getEvent('Company registration')->start_at
                    && $this->getEvent('Company registration')->end_at >= Carbon::today())
        );
    }

    /**
     * Check if the participant registration is opened
     * @return Attribute
     */
    public function isParticipantRegistrationOpened(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->state == Edition::STATE_ANNOUNCE
                    || $this->state == Edition::STATE_ENROLLMENT)
                && (Carbon::now() >= $this->getEvent('Participant registration')->start_at
                    && $this->getEvent('Participant registration')->end_at >= Carbon::now())
        );
    }

    /**
     * Check if requesting presentations is opened
     * @return Attribute
     */
    public function isRequestingPresentationOpened(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->state == Edition::STATE_ANNOUNCE
                && (Carbon::now() >= $this->getEvent('Presentation request')->start_at
                    && $this->getEvent('Presentation request')->end_at >= Carbon::now())
        );
    }

    /**
     * Determine whether the edition is in progress
     * TODO: change the '||' to '&&' once the automation of the state change is implemented
     *
     * @return Attribute
     */
    public function isInProgress(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->state == Edition::STATE_EXECUTION
                || (Carbon::now() >= $this->start_at && Carbon::now() <= $this->end_at)
        );
    }

    /**
     * Determine whether the edition is over
     *
     * @return Attribute
     */
    public function isOver(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->state == Edition::STATE_ARCHIVE
                || Carbon::now() >= $this->end_at
        );
    }

    /**
     * Gets an instance that represents the current edition, meaning the
     * edition that is currently opened for registration, in state of enrollment or executed
     *
     * @return Edition|null
     */
    public static function current() : ?self
    {
        return self::query()
            ->whereNot('state', '=', self::STATE_DESIGN)
            ->whereNot('state', '=', self::STATE_ARCHIVE)
            ->first();
    }

    /**
     * Determine the state to display on the page
     *
     * @return Attribute
     */
    public function displayedState(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->state == Edition::STATE_DESIGN) {
                    return 'Design';
                } elseif ($this->is_company_registration_opened) {
                    return 'Company registration opened';
                } elseif ($this->is_participant_registration_opened) {
                    return 'Participant registration opened';
                } elseif ($this->state == Edition::STATE_ANNOUNCE) {
                    return 'Announced';
                } elseif ($this->is_final_programme_released) {
                    return 'Final programme released';
                } elseif ($this->state == Edition::STATE_EXECUTION) {
                    return 'In progress';
                } else {
                    return 'Archived';
                }
            }
        );
    }

    /**
     * Determine whether all the dates of the edition were added
     *
     * @return Attribute
     */
    public function configured(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->start_at || !$this->end_at) {
                    return false;
                }

                foreach ($this->editionEvents as $event) {
                    if (!$event->start_at || !$event->end_at) {
                        return false;
                    }
                }

                return true;
            }
        );
    }

    /**
     * Determine whether the keynote speaker details were added
     *
     * @return Attribute
     */
    public function keynoteConfigured(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->keynote_photo_path && $this->keynote_name && $this->keynote_description)
        );
    }

    /**
     * Changes state of the edition to 'announce', which means that it is officially opened for registration
     * of companies
     *
     * @return void
     */
    public function activate()
    {
        // check if the dates are configured
        if ($this->configured()) {
            // archive current active edition, if exists
            $currentEdition = self::current();
            if ($currentEdition) {
                $currentEdition->state = self::STATE_ARCHIVE;
                $currentEdition->save();
            }

            // activate the edition
            $this->state = self::STATE_ANNOUNCE;
            $this->save();
        }
    }

    /**
     * Adds an event to the edition
     *
     * @param Event $event event to attach to edition
     * @return void
     */
    public function addEvent(Event $event): void
    {
        if (!$this->editionEvents->contains($event)) {
            EditionEvent::create([
                'edition_id' => $this->id,
                'event_id' => $event->id,
            ]);
        }
    }

    /**
     * Removes an event from the edition
     *
     * @param Event $event event to remove from edition
     * @return void
     */
    public function removeEvent(Event $event): void
    {
        $editionEvent = $this->editionEvents
            ->where('edition_id', '=', $this->id)
            ->where('event_id', '=', $event->id)
            ->first();

        if ($editionEvent) {
            $editionEvent->delete();
        }
    }

    /**
     * Returns information about event for the particular edition
     *
     * @param string $name of the event to look for
     * @return EditionEvent
     */
    public function getEvent(string $name): EditionEvent
    {
        return $this->editionEvents
            ->where('event_id', Event::where('name', $name)->first()->id)
            ->first();
    }

    /**
     * Function that makes sure that the keynote has a picture even if it is
     * just the default avatar
     * @return Attribute
     */
    public function keynotePictureSource(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->keynote_photo_path) {
                    return url('storage/' . $this->keynote_photo_path);
                } else {
                    $name = trim(collect(explode(' ', $this->keynote_name))->map(function ($segment) {
                        return mb_substr($segment, 0, 1);
                    })->join(' '));

                    return 'https://ui-avatars.com/api/?name=' .
                        urlencode($name) .
                        '&color=7F9CF5&background=EBF4FF&size=128';
                }
            }
        );
    }
}

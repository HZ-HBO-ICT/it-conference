<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property Carbon|null $start_at
 * @property Carbon|null $end_at
 * @property boolean $is_final_programme_released
 * @property boolean $is_participant_registration_opened
 * @property boolean $is_company_registration_opened
 * @property boolean $is_requesting_presentation_opened
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Edition newModelQuery()
 * @method static Builder|Edition newQuery()
 * @method static Builder|Edition query()
 * @method static Builder|Edition whereCreatedAt($value)
 * @method static Builder|Edition whereId($value)
 * @method static Builder|Edition whereName($value)
 * @method static Builder|Edition whereState($value)
 * @method static Builder|Edition whereStartAt($value)
 * @method static Builder|Edition whereEndAt($value)
 * @method static Builder|Edition whereUpdatedAt($value)
 * @mixin Eloquent
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
        'workshop_duration'
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
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
            'lecture_duration' => 'required|numeric|min:1',
            'workshop_duration' => 'required|numeric|min:1'
        ];
    }

    /**
     * Establishes a relationship between Edition and EditionEvent models (events that are executed during given edition)
     * @return HasMany
     */
    public function editionEvents(): HasMany
    {
        return $this->hasMany(EditionEvent::class);
    }

    /**
     * Get the event's is_final_programme_released value
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

    public function isCompanyRegistrationOpened(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->state == Edition::STATE_ANNOUNCE
                || $this->state == Edition::STATE_ENROLLMENT
                || $this->state == Edition::STATE_EXECUTION
        );
    }

    public function isParticipantRegistrationOpened(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->state == Edition::STATE_ANNOUNCE
                || $this->state == Edition::STATE_ENROLLMENT
                || $this->state == Edition::STATE_EXECUTION)
                && Carbon::now() >= $this->getEvent('Participant registration')->start_at
        );
    }

    public function isRequestingPresentationOpened(): Attribute
    {
        return Attribute::make(
            get: fn() => ($this->state == Edition::STATE_ENROLLMENT
                || $this->state == Edition::STATE_EXECUTION)
                && Carbon::now() >= $this->getEvent('Presentation request')->start_at
        );
    }

    /**
     * Gets an instance that represents the current edition, meaning the
     * edition that is currently opened for registration, in state of enrollment or executed
     *
     * @return Builder|Model|object|null
     */
    public static function current()
    {
        return self::query()
            ->whereNot('state', '=', self::STATE_DESIGN)
            ->whereNot('state', '=', self::STATE_ARCHIVE)
            ->first();
    }

    /**
     * Checks if all the dates of a particular edition were added
     * @return bool
     */
    public function configured(): bool
    {
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

    /**
     * Changes state of the edition to 'announce', which means that it is officially opened for registration
     * of companies
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

            // synchronize start date of company registration event to the date of the manual activation
            $this->getEvent('Company registration')->syncStartDate();

            // activate the edition
            $this->state = self::STATE_ANNOUNCE;
            $this->save();
        }
    }

    /**
     * Adds an event to the edition
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
     * Synchronize start date of the edition to the current date
     * @return void
     */
    public function syncStartDate(): void
    {
        $this->start_at = Carbon::today();
        $this->save();
    }
}

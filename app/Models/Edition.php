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
// * @property boolean $is_final_programme_released
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
        'end_at'
    ];

    const STATE_DESIGN = 10;
    const STATE_ANNOUNCE = 20;
    const STATE_ENROLLMENT = 30;
    const STATE_EXECUTION = 40;
    const STATE_ARCHIVE = 50;

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
//    protected function isFinalProgrammeReleased(): Attribute
//    {
//        return Attribute::make(
//            get: fn() => $this->state == Edition::STATE_ENROLLMENT
//                || $this->state == Edition::STATE_EXECUTION
//        );
//    }

    /**
     * Gets an instance that represents the current event, meaning the
     * event that is currently opened for registration, in state of enrollment or executed
     *
     * @return Builder|Model|object|null
     */
    public static function current()
    {
        return self::query()
            ->whereNot('state', '=', self::STATE_DESIGN)
            ->orWhereNot('state', '=', self::STATE_ARCHIVE)
            ->first();
    }

    /**
     * Changes state of the edition to 'announce', which means that it is officially opened for registration
     * of companies
     * @return void
     */
    public function activate()
    {
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

    /**
     * Adds an event to the edition
     * @param Event $event event to attach to edition
     * @return void
     */
    public function addEvent(Event $event)
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
    public function removeEvent(Event $event)
    {
        $editionEvent = $this->editionEvents
            ->where('edition_id', '=', $this->id)
            ->where('event_id', '=', $event->id)
            ->first();

        if ($editionEvent) {
            $editionEvent->delete();
        }
    }
}

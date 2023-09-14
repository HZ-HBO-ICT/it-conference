<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * \App\Models\EventInstance
 *
 * @property int $id
 * @property string $name
 * @property int $state
 * @property boolean $is_final_programme_released
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|EventInstance newModelQuery()
 * @method static Builder|EventInstance newQuery()
 * @method static Builder|EventInstance query()
 * @method static Builder|EventInstance whereCreatedAt($value)
 * @method static Builder|EventInstance whereId($value)
 * @method static Builder|EventInstance whereName($value)
 * @method static Builder|EventInstance whereState($value)
 * @method static Builder|EventInstance whereUpdatedAt($value)
 * @mixin Eloquent
 */
class EventInstance extends Model
{
    use HasFactory;

    const STATE_NEW = 0;
    const STATE_DESIGN = 10;
    const STATE_ENROLLMENT = 20;
    const STATE_EXECUTION = 30;
    const STATE_ARCHIVE = 40;

    /**
     * Get the event's is_final_programme_released value
     *
     * @return Attribute
     */
    protected function isFinalProgrammeReleased(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->state == EventInstance::STATE_ENROLLMENT
                || $this->state == EventInstance::STATE_EXECUTION
        );
    }

    /**
     * Gets or creates an instance that represents the current event, meaning the
     * event that is currently in planning or executed
     *
     * @return Builder|Model|object|null
     */
    public static function current() {
        $item = self::query()
            ->whereNot('state', '=', self::STATE_ARCHIVE)
            ->first();
        if (!$item) {
            $item = self::create();
        }
        return $item;
    }


}

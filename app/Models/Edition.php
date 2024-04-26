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

    protected $fillable = ['name', 'state', 'start_at', 'end_at'];

    const STATE_DESIGN = 10;
    const STATE_ENROLLMENT = 20;
    const STATE_EXECUTION = 30;
    const STATE_ARCHIVE = 40;

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
     * Gets or creates an instance that represents the current event, meaning the
     * event that is currently in planning or executed
     *
     * @return Builder|Model|object|null
     */
    public static function current()
    {
        //        if (!$item) {
        //            $item = self::create();
        //        }
        return self::query()
            ->whereNot('state', '=', self::STATE_ARCHIVE)
            ->first();
    }
}

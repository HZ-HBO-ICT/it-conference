<?php

namespace App\Models;

use App\Http\Controllers\TimeslotController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Timeslot
 *
 * @property int $id
 * @property string $start
 * @property int $duration The duration of the presentation in minutes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static \Database\Factories\TimeslotFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timeslot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Timeslot extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'duration'];

    /**
     * All the presentations that are in the timeslot
     * @return HasMany
     */
    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }
}

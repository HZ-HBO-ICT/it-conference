<?php

namespace App\Models;

use App\Http\Controllers\TimeslotController;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\TimeslotFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Timeslot
 *
 * @property int $id
 * @property string $start
 * @property int $duration The duration of the presentation in minutes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Presentation> $presentations
 * @property-read int|null $presentations_count
 * @method static TimeslotFactory factory($count = null, $state = [])
 * @method static Builder|Timeslot newModelQuery()
 * @method static Builder|Timeslot newQuery()
 * @method static Builder|Timeslot query()
 * @method static Builder|Timeslot whereCreatedAt($value)
 * @method static Builder|Timeslot whereDuration($value)
 * @method static Builder|Timeslot whereId($value)
 * @method static Builder|Timeslot whereStart($value)
 * @method static Builder|Timeslot whereUpdatedAt($value)
 * @mixin Eloquent
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

    /**
     * The timeslot that is with the closest starting time to the one that called the method
     */
    public function closestStartingTimeslot()
    {
        $startDatetime = date('Y-m-d H:i:s', strtotime('today ' . $this->start));

        return $this->where('id', '!=', $this->id)
            ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, start, ?))', [$startDatetime])
            ->first();
    }

    /**
     * Returns the hour in which the last presentation excluding closing (default presentation)
     */
    public static function getTheLatestEndingUsed()
    {
        $usedTimeslotsId = Presentation::pluck('timeslot_id');

        return self::whereIn('id', $usedTimeslotsId)
            ->get()
            ->max(function (Timeslot $timeslot) {
                $start = Carbon::parse($timeslot->start);
                return $start->addMinutes($timeslot->duration);
            });
    }

    /**
     * Returns the usual free time (padding) between timeslots
     * @return int
     */
    public static function paddingBetweenSlots(): int
    {
        $defaultPresentationTimeslotIds = [DefaultPresentation::opening()->timeslot->id,
            DefaultPresentation::closing()->timeslot->id];

        $timeslots = Timeslot::whereNotIn('id', $defaultPresentationTimeslotIds)
            ->orderBy('duration', 'desc')
            ->orderBy('start', 'asc')
            ->take(2)
            ->get();

        return Carbon::parse($timeslots[1]->start)
            ->diffInMinutes(Carbon::parse($timeslots[0]->start)->addMinutes($timeslots[0]->duration));
    }
}

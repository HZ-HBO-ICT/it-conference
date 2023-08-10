<?php

namespace App\Models;

use App\Http\Controllers\TimeslotController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Generates timeslots for the presentations
     * @param $startingTime
     * @param $endingTime
     * @return void
     */
    public static function generate($startingTime, $endingTime)
    {
        (new TimeslotController())->generateTimeslots($startingTime, '12:30');
        (new TimeslotController())->generateTimeslots('13:00', $endingTime);
    }
}

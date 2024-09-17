<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timeslot extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'duration'];

    /**
     * Establishes a relationship between the timeslot and
     * the presentations in it
     * @return HasMany
     */
    public function presentations(): HasMany
    {
        return $this->hasMany(Presentation::class);
    }

    /**
     * Generates the possible timeslots for the schedule
     * Warning: To be called after present opening and closing
     * @return void
     * @throws \Exception
     */
    public static function generateTimeslots()
    {
        $startTime = DefaultPresentation::opening()->end; // The presentations can start after the opening ends
        $endTime = DefaultPresentation::closing()->start; // The presentations must end before closing starts
        $timezone = new DateTimeZone('Europe/Amsterdam');

        $currentTime = new DateTime($startTime, $timezone);
        $endTime = new DateTime($endTime, $timezone);
        $endTimeFullBody = clone $endTime;
        $endTimeFullBody->modify('-30 minutes');

        // Handle initial partial slot
        if ($currentTime->format('i') != '00' && $currentTime->format('i') != '30') {
            $minutesToNextSlot = 30 - ($currentTime->format('i') % 30);
            Timeslot::create([
                'start' => $currentTime->format('H:i'),
                'duration' => $minutesToNextSlot
            ]);

            $currentTime->modify("+{$minutesToNextSlot} minutes");
        }

        while ($currentTime < $endTimeFullBody) {
            $timeHourFormatted = $currentTime->format('H:i');
            Timeslot::create([
                'start' => $timeHourFormatted,
                'duration' => 30
            ]);
            $currentTime->modify('+30 minutes');
        }

        // Handle final partial slot
        if ($currentTime != $endTime) {
            $remainingSeconds = $endTime->getTimestamp() - $currentTime->getTimestamp();
            if ($remainingSeconds > 0) {
                Timeslot::create([
                    'start' => $currentTime->format('H:i'),
                    'duration' => $remainingSeconds / 60
                ]);
            }
        }
    }
}

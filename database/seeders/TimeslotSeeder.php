<?php

namespace Database\Seeders;

use App\Models\Timeslot;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTime = 8; // 8 AM
        $endTime = 18;  // 6 PM
        $currentTime = $startTime;
        $timezone = new DateTimeZone('Europe/Amsterdam');

        while ($currentTime < $endTime) {
            $timeHour = new DateTime(sprintf('%02d:00', $currentTime), $timezone);
            $timeHalfHour = new DateTime(sprintf('%02d:30', $currentTime), $timezone);

            $timeHourFormatted = $timeHour->format('H:i');
            $timeHalfHourFormatted = $timeHalfHour->format('H:i');

            Timeslot::create([
                'start' => $timeHourFormatted,
                'duration' => 30
            ]);

            Timeslot::create([
                'start' => $timeHalfHourFormatted,
                'duration' => 30
            ]);

            $currentTime++;
        }
    }
}

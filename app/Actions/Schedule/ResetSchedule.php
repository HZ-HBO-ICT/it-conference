<?php

namespace App\Actions\Schedule;

use App\Models\DefaultPresentation;
use App\Models\Presentation;
use App\Models\Timeslot;

class ResetSchedule
{
    /**
     * Abstracts the resetting of the schedule
     * $type == 'full' - removing all scheduling from the presentation; removing the timeslots and the opening/closing
     * $type == 'scheduled' - removing all scheduling from the presentation
     *
     * @param $type
     * @return void
     */
    public static function reset($type)
    {
        Presentation::query()->update([
            'room_id' => null,
            'timeslot_id' => null,
            'start' => null
        ]);

        if ($type == 'full') {
            DefaultPresentation::truncate();

            // Truncate does not work when model is FK
            foreach (Timeslot::all() as $timeslot) {
                $timeslot->delete();
            }
        }
    }
}

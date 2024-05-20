<?php

namespace App\Actions\Schedule;

use Carbon\Carbon;

class PresentationAllocationHelper
{
    /**
     * Calculates if it is possible to set the presentation in the wanted timeslot
     * and the possible starting
     * @param $presentation
     * @param $timeslot
     * @param $room
     * @return Carbon|null returns the possible starting time or null if it is impossible
     */
    public function tryToSchedulePresentationInTimeslot($presentation, $timeslot, $room): ?Carbon
    {
        $conflictChecker = new PresentationConflictChecker();

        $previousPresentation = $conflictChecker->findConflictPresentationBefore($room, $timeslot->start);

        // This means something is going wrong, if the conflict is not because of starting time,
        // it's because of ending one
        if (is_null($previousPresentation)) {
            return null;
        }

        $startingTime = Carbon::parse($previousPresentation->start)
            ->copy()->addMinutes($previousPresentation->duration);
        $timeslotEndingTime = Carbon::parse($timeslot->start)
            ->copy()->addMinutes(30);

        // Means that it cannot be scheduled at all within the wanted timeslot
        if ($startingTime->gte($timeslotEndingTime)) {
            return null;
        }

        $nextPresentation = $conflictChecker->findConflictPresentationAfter($room, $startingTime, $presentation);

        return is_null($nextPresentation) || $nextPresentation->id == $presentation->id
            ? $startingTime
            : null;
    }
}

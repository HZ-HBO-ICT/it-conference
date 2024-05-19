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
        $startingTime = Carbon::parse($previousPresentation->start)
            ->copy()->addMinutes($previousPresentation->duration);

        $nextPresentation = $conflictChecker->findConflictPresentationAfter($room, $startingTime, $presentation);

        return is_null($nextPresentation) || $nextPresentation->id == $presentation->id
            ? $startingTime
            : null;
    }
}

<?php

namespace App\Actions\Schedule;

use App\Models\Timeslot;
use Carbon\Carbon;

class PresentationAllocationHelper
{
    /**
     * Determines whether the allocation helper can help in scheduling
     * @param $presentation
     * @param $timeslot
     * @param $room
     * @return int 0 - cannot help; 1 - can allocate in given timeslot;
     * 2 - can allocate in timeslot previous to the give one
     */
    public function canHelp($presentation, $timeslot, $room)
    {
        if ($this->tryToSchedulePresentationInTimeslot($presentation, $timeslot, $room)) {
            return 1;
        } else if ($this->tryToScheduleInPreviousTimeslot($presentation, $timeslot, $room)) {
            return 2;
        }

        return 0;
    }

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

    public function tryToScheduleInPreviousTimeslot($presentation, $timeslot, $room)
    {
        $prevTimeslot = Timeslot::find($timeslot->id - 1);

        $conflictChecker = new PresentationConflictChecker();

        $nextPresentation = $conflictChecker->findConflictPresentationAfter($room, $timeslot->start, $presentation);

        // If the following presentation is not creating the conflict, then something wrong is going on
        if (is_null($nextPresentation)) {
            return null;
        }

        $proposedStartingTime = Carbon::parse($nextPresentation->start)->copy()->subMinutes($presentation->duration);
        $previousPresentation = $conflictChecker
            ->findConflictPresentationBefore($room, $proposedStartingTime->format('H:i'));

        return is_null($previousPresentation) || $previousPresentation->id == $presentation->id
            ? $proposedStartingTime
            : null;
    }

    /**
     * Based on the starting time, determine in which timeslot does the time fall
     * @param $startingTime
     * @return Timeslot|mixed|null returns the timeslot it finds or null if such does not exist
     */
    public function findTimeslotByStartingTime($startingTime)
    {
        $timeslots = Timeslot::all();
        foreach ($timeslots as $timeslot) {
            $timeslotEndTime = Carbon::parse($timeslot->start)->copy()->addMinutes($timeslot->duration);
            if ($startingTime->between(Carbon::parse($timeslot->start), $timeslotEndTime)) {
                return $timeslot;
            }
        }

        return null;
    }
}

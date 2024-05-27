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
        } elseif ($this->tryToScheduleInPreviousTimeslot($presentation, $timeslot, $room)) {
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

        $proposedStartingTime = Carbon::parse($previousPresentation->start)
            ->copy()->addMinutes($previousPresentation->duration);
        $timeslotEndingTime = Carbon::parse($timeslot->start)
            ->copy()->addMinutes(30);

        // Means that it cannot be scheduled at all within the wanted timeslot
        if ($proposedStartingTime->gte($timeslotEndingTime)) {
            return null;
        }

        $nextPresentation = $conflictChecker
            ->findConflictPresentationAfter($room, $proposedStartingTime, $presentation);

        $conflictChecker = new PresentationConflictChecker();
        if (!$conflictChecker->isWithinBoundariesOfTheDay($presentation, $proposedStartingTime)) {
            return null;
        }

        return is_null($nextPresentation) || $nextPresentation->id == $presentation->id
            ? $proposedStartingTime
            : null;
    }

    /**
     * If the timeslot in which the user is trying to allocate, the presentation is too busy
     * try to allocate in previous timeslot in a way to still cover the free part of the desired timeslot
     * @param $presentation
     * @param $timeslot
     * @param $room
     * @return Carbon|null
     */
    public function tryToScheduleInPreviousTimeslot($presentation, $timeslot, $room): ?Carbon
    {
        $proposedStartingTime = Carbon::parse($timeslot->start)
                                    ->copy()->subMinutes($presentation->duration);
        $proposedTimeslot = $this->findTimeslotByStartingTime($proposedStartingTime);

        $conflictChecker = new PresentationConflictChecker();
        $nextPresentation = $conflictChecker->findConflictPresentationAfter($room, $proposedStartingTime, $presentation);

        // If there is a presentation after the suggested time calculation that causes a conflict,
        // nothing can be done as of now
        if (!is_null($nextPresentation)) {
            return null;
        }

        $conflictChecker = new PresentationConflictChecker();
        $previousPresentation = $conflictChecker
            ->findConflictPresentationBefore($room, $proposedStartingTime->copy()->format('H:i'));

        if (!$conflictChecker->isWithinBoundariesOfTheDay($presentation, $proposedStartingTime)) {
            return null;
        }

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
        $startingTime = Carbon::parse($startingTime);
        foreach ($timeslots as $timeslot) {
            $timeslotEndTime = Carbon::parse($timeslot->start)->copy()->addMinutes($timeslot->duration);
            if ($startingTime->gte(Carbon::parse($timeslot->start)) && $startingTime->lt($timeslotEndTime)) {
                return $timeslot;
            }
        }

        return null;
    }
}

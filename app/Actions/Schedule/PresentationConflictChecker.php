<?php

namespace App\Actions\Schedule;

use App\Models\Presentation;
use App\Models\Timeslot;
use Carbon\Carbon;

class PresentationConflictChecker
{
    /**
     * Based on the passed presentation, room and new start estimates if there
     * are any conflicts in the scheduling system
     * @param $presentation
     * @param $room
     * @param $start
     * @return bool
     */
    public function isClearOfConflicts($presentation, $room, $start): bool
    {
        $previousPresentation = $this->findConflictPresentationBefore($room, $start);
        $nextPresentation = $this->findConflictPresentationAfter($room, $start, $presentation);

        // Case 0 - Conditional: The presentation needs to be within the boundaries of the day
        if (!$this->isWithinBoundariesOfTheDay($presentation, $start)) {
            return false;
        }

        // Case 1: No presentations in the room before this one or after it that cause conflict
        if (is_null($previousPresentation)
            && is_null($nextPresentation)) {
            return true;
        }

        // Case 2: Next presentation that causes conflict is
        // actually the same presentation trying to be moved later
        if (!is_null($nextPresentation)
            && $presentation->id == $nextPresentation->id
            && is_null($previousPresentation)) {
            return true;
        }

        // Case 3: Previous presentation that causes conflict is
        // actually the same presentation trying to be moved earlier
        if (!is_null($previousPresentation)
            && $presentation->id == $previousPresentation->id
            && is_null($nextPresentation)) {
            return true;
        }

        return false;
    }

    /**
     * Finds the closest starting presentation before the suggested start time
     * to check if a conflict occurs
     * @param $room
     * @param $suggestedStart
     * @return mixed|null null if there is no conflict, otherwise the presentation that causes the conflict
     */
    public function findConflictPresentationBefore($room, $suggestedStart): mixed
    {
        $presentationStartTime = Carbon::parse($suggestedStart);

        $potentialConflict = $room->presentations()
            ->where('start', '<', $presentationStartTime)
            ->orderBy('start', 'desc')
            ->first();

        if (is_null($potentialConflict)) {
            return null;
        }

        $duration = $potentialConflict->type == 'workshop' ?
            Presentation::$WORKSHOP_DURATION :
            Presentation::$LECTURE_DURATION;

        return Carbon::parse($potentialConflict->start)->copy()->addMinutes($duration) <= $presentationStartTime
            ? null
            : $potentialConflict;
    }

    /**
     * Finds the closest starting presentation after the suggested start time
     * to check if a conflict occurs
     * @param $room
     * @param $suggestedStart
     * @param $presentation
     * @return mixed|null null if there is no conflict, otherwise the presentation that causes the conflict
     */
    public function findConflictPresentationAfter($room, $suggestedStart, $presentation): mixed
    {
        $duration = $presentation->type == 'workshop' ?
            Presentation::$WORKSHOP_DURATION :
            Presentation::$LECTURE_DURATION;
        $presentationStartTime = Carbon::parse($suggestedStart);
        $presentationEndTime = $presentationStartTime->copy()->addMinutes($duration);

        $potentialConflict = $room->presentations()
            ->where('start', '>=', $presentationStartTime)
            ->orderBy('start', 'asc')
            ->first();

        if (is_null($potentialConflict)) {
            return null;
        }

        $duration = $potentialConflict->type == 'workshop' ?
            Presentation::$WORKSHOP_DURATION :
            Presentation::$LECTURE_DURATION;

        return $presentationEndTime <= Carbon::parse($potentialConflict->start)
            ? null
            : $potentialConflict;
    }

    public function isWithinBoundariesOfTheDay($presentation, $startTime)
    {
        $endTime = Carbon::parse($startTime)->copy()->addMinutes($presentation->duration);

        $lastTimeslot = Timeslot::all()
            ->sortByDesc('start')
            ->first();

        $firstTimeslot = Timeslot::all()
            ->first();

        return $endTime->lte(Carbon::parse($lastTimeslot->start)->addMinutes(30))
            && Carbon::parse($startTime)->gte(Carbon::parse($firstTimeslot->start));
    }
}

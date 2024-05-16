<?php

namespace App\Livewire\Schedule;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Cell extends Component
{
    public $id;
    public $timeslot;
    public $room;
    public $presentations;

    public function mount($timeslot, $room)
    {
        $this->timeslot = $timeslot;
        $this->room = $room;
        $this->id = "r-{$this->room->id}-t-{$this->timeslot->id}";
        $this->presentations = $this->room->presentations()
            ->where('start', '>=', Carbon::parse($this->timeslot->start))
            ->where('start', '<', Carbon::parse($this->timeslot->start)->copy()->addMinutes(30))
            ->orderBy('start', 'asc')
            ->get();
    }

    public function movePresentation($id, $newRoom, $newTimeslot)
    {
        $presentation = Presentation::find($id);
        if ($presentation) {
            $room = Room::find($newRoom);
            $timeslot = Timeslot::find($newTimeslot);

            if ($this->isClearOfConflicts($presentation, $room, $timeslot)) {
                $this->dispatchMovingEventToGrid($presentation->id, $room->id, $timeslot->id, $timeslot->start);
            }
        }
    }

    public function isClearOfConflicts($presentation, $room, $timeslot)
    {
        $previousPresentation = $this->findConflictPresentationBefore($room, $timeslot->start, $presentation);
        $nextPresentation = $this->findConflictPresentationAfter($room, $timeslot->start, $presentation);

        // Case 1: No presentations in the room before this one or after it that causes conflict
        if (is_null($previousPresentation)
            && is_null($nextPresentation)) {
            return true;
        }

        // Case 2: Next presentation that causes conflict is actually the same presentation trying to be moved later
        if (!is_null($nextPresentation) && $presentation->id == $nextPresentation->id && is_null($previousPresentation)) {
            return true;
        }

        // Case 3: Previous presentation that causes conflict is
        // actually the same presentation trying to be moved earlier
        if (!is_null($previousPresentation) && $presentation->id == $previousPresentation->id && is_null($nextPresentation)) {
            return true;
        }

        return false;
    }

    public function findConflictPresentationBefore($room, $suggestedStart, $presentation)
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

    public function findConflictPresentationAfter($room, $suggestedStart, $presentation)
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

    public function dispatchMovingEventToGrid($id, $newRoom, $newTimeslot, $newTime)
    {
        $this->dispatch('move-presentation', data: [
            'presentation_id' => $id,
            'new_room_id' => $newRoom,
            'new_timeslot_id' => $newTimeslot,
            'new_time' => $newTime
        ]);
    }

    #[On("update-cell-{id}")]
    public function refresh()
    {
        $timeslotStart = Carbon::parse($this->timeslot->start);
        $this->presentations = $this->room->presentations()
            ->where('start', '>=', $timeslotStart)
            ->where('start', '<', $timeslotStart->copy()->addMinutes(30))
            ->orderBy('start', 'asc')
            ->get();

    }

    public function render()
    {
        return view('livewire.schedule.cell');
    }
}

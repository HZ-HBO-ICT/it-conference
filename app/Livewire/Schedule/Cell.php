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
            ->where('start', '<', Carbon::parse($this->timeslot->start)->addMinutes(30))
            ->orderBy('start', 'asc')
            ->get();
    }

    public function movePresentation($id, $fromRoom, $newRoom, $newTimeslot)
    {
        $presentation = Presentation::find($id);
        $room = Room::find($newRoom);
        $timeslot = Timeslot::find($newTimeslot);

        if ($this->isCausingConflicts($presentation, $room, $timeslot)) {
            $this->dispatchMovingEventToGrid($presentation->id, $room->id, $timeslot->id, $timeslot->start);
        }
    }

    public function isCausingConflicts($presentation, $room, $timeslot)
    {
        $previousPresentation = $this->findClosestPresentationBefore($room, $timeslot->start);
        $nextPresentation = $this->findClosestPresentationAfter($room, $timeslot->start, $presentation);

        // Case 1: No presentations in the room before this one or after it
        if (is_null($previousPresentation)
            && is_null($nextPresentation)) {
            return true;
        }
    }

    public function findClosestPresentationBefore($room, $suggestedStart)
    {
        $presentationStartTime = Carbon::parse($suggestedStart);

        return $room->presentations()
            ->where('start', '<', $presentationStartTime)
            ->orderBy('start', 'desc')
            ->first();
    }

    public function findClosestPresentationAfter($room, $suggestedStart, $presentation)
    {
        $duration = $presentation->type == 'workshop' ?
            Presentation::$WORKSHOP_DURATION :
            Presentation::$LECTURE_DURATION;
        $presentationStartTime = Carbon::parse($suggestedStart);
        $presentationEndTime = Carbon::parse($suggestedStart)->addMinutes($duration);

        return $room->presentations()
            ->where('start', '>', $presentationStartTime)
            ->where('start', '<', $presentationEndTime)
            ->orderBy('start', 'asc')
            ->first();
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

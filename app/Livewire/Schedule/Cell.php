<?php

namespace App\Livewire\Schedule;

use App\Actions\Schedule\PresentationConflictChecker;
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

            $presentationChecker = new PresentationConflictChecker();
            if ($presentationChecker->isClearOfConflicts($presentation, $room, $timeslot->start)) {
                $this->dispatchMoveEventToGrid($presentation->id, $room->id, $timeslot->id, $timeslot->start);
            }
        }
    }


    public function dispatchMoveEventToGrid($id, $newRoom, $newTimeslot, $newTime)
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

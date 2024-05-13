<?php

namespace App\Livewire\Schedule;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class GridParentComponent extends Component
{
    public $rooms;
    public $timeslots;
    public $unscheduledPresentations;

    public function mount()
    {
        $this->rooms = Room::all();
        $this->timeslots = Timeslot::all();

        $this->unscheduledPresentations = Presentation::where(function ($presentation) {
            return $presentation->whereNull(['timeslot_id', 'room_id']);
        })->get();
    }

    #[On('move-presentation')]
    public function proccessMovingPresentation($data)
    {
        $presentation = Presentation::find($data['presentation_id']);
        $oldRoom = $presentation->room;
        $oldTimeslot = $presentation->timeslot;

        $presentation->update([
            'room_id' => $data['new_room_id'],
            'timeslot_id' => $data['new_timeslot_id'],
            'start' => $data['new_time']
        ]);
        $presentation->save();
        $presentation->refresh();

        if ($oldRoom && $oldTimeslot) {
            $this->dispatch("update-cell-r-{$oldRoom->id}-t-{$oldTimeslot->id}");
        } else {
            $this->unscheduledPresentations = Presentation::where(function ($presentation) {
                return $presentation->whereNull(['timeslot_id', 'room_id']);
            })->get();
        }

        $this->dispatch("update-cell-r-{$presentation->room->id}-t-{$presentation->timeslot->id}");

    }

    public function render()
    {
        return view('livewire.schedule.grid-parent-component');
    }
}

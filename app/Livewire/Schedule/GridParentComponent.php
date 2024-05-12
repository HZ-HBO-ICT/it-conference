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
        $presentation->update([
            'room_id'=>$data['new_room_id'],
            'timeslot_id'=>$data['new_timeslot_id'],
            'start'=>$data['new_time']
        ]);
        $presentation->save();
        $presentation->refresh();
        dd($presentation);
    }

    public function createsConflict($presentation, $timeslot, $room)
    {
        $duration = $presentation->type === 'lecture'
            ? Presentation::$LECTURE_DURATION
            : Presentation::$WORKSHOP_DURATION;

        $end = Carbon::parse($presentation->start)->addMinutes($duration);
    }

    public function reorderPresentations($list)
    {
        foreach ($list as $order => $item) {
            Presentation::find($item['value'])->update(['order' => $order, 'room_id' => $item['group']]);
        }
    }

    public function moveToRoom($presentationId, $newRoomId)
    {
        Presentation::find($presentationId)->update(['room_id' => $newRoomId]);
        $this->emitSelf('refreshComponent'); // Optionally refresh the component to reflect changes
    }


    public function render()
    {
        return view('livewire.schedule.grid-parent-component');
    }
}

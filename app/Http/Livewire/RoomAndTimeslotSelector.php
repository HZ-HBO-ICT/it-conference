<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ScheduleController;
use App\Models\Room;
use App\Models\Timeslot;
use Livewire\Component;

class RoomAndTimeslotSelector extends Component
{
    public $presentation;

    public $rooms;
    public $timeslots;

    public $maxParticipants;

    public $selectedRoom;

    public function mount()
    {
        $this->rooms = Room::all();

        if ($this->presentation->room) {
            $this->selectedRoom = $this->presentation->room_id;
            $this->updatedSelectedRoom($this->presentation->room_id);
        }
    }

    public function updatedSelectedRoom($value)
    {
        if ($this->selectedRoom) {
            $allTimeslots = Timeslot::where('duration', $this->presentation->type == 'lecture' ? 30 : 90)
                ->get();
            $room = Room::find($this->selectedRoom);

            $timeslotIds = $allTimeslots->filter(function ($timeslot) use ($room) {
                return (new ScheduleController())->checkIfTimeslotAndRoomAreAvailable($room, $timeslot);
            })->pluck('id');

            if ($this->selectedRoom == $this->presentation->room_id) {
                $timeslotIds[] = $this->presentation->timeslot_id;
            }

            $this->timeslots = Timeslot::whereIn('id', $timeslotIds)->get();
            $this->getMaxParticipants();
        }
    }

    public function getMaxParticipants(): void
    {
        $this->maxParticipants = Room::find($this->selectedRoom)->max_participants < $this->presentation->max_participants
            ? Room::find($this->selectedRoom)->max_participants
            : $this->presentation->max_participants;
    }

    public function resetTimeslot()
    {
        $this->presentation->timeslot_id = null;
        $this->presentation->room_id = null;
        $this->presentation->save();

        return redirect()->to(route('moderator.schedule.presentation', $this->presentation));
    }

    public function render()
    {
        return view('livewire.room-and-timeslot-selector');
    }
}

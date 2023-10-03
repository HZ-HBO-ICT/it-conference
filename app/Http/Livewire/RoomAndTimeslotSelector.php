<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ScheduleController;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\View\View;
use Livewire\Component;

class RoomAndTimeslotSelector extends Component
{
    public $presentation;
    public $rooms;
    public $timeslots;
    public $maxParticipants;
    public $selectedRoom;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->rooms = Room::all();

        if ($this->presentation->room) {
            $this->selectedRoom = $this->presentation->room_id;
            $this->updatedSelectedRoom($this->presentation->room_id);
        }
    }

    /**
     * Updates info from the selected room from $value.
     * @param $value
     * @return void
     */
    public function updatedSelectedRoom($value): void
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

    /**
     * Returns the maximum amount of participants.
     * @return void
     */
    public function getMaxParticipants(): void
    {
        $this->maxParticipants = Room::find($this->selectedRoom)->max_participants < $this->presentation->max_participants
            ? Room::find($this->selectedRoom)->max_participants
            : $this->presentation->max_participants;
    }

    /**
     * Displays the room and timeslot view selector.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.room-and-timeslot-selector');
    }
}

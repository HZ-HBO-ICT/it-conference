<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Crew\ScheduleController;
use App\Models\DefaultPresentation;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Livewire\Component;

class RoomAndTimeslotSelector extends Component
{
    public $presentation;

    public $rooms;
    public $timeslots;

    public $maxParticipants;

    public $selectedRoom;

    /**
     * Triggered on initializing the component
     * @return void
     */
    public function mount()
    {
        $this->rooms = Room::all();

        if ($this->presentation->room) {
            $this->selectedRoom = $this->presentation->room_id;
            $this->updatedSelectedRoom($this->presentation->room_id);
        }
    }

    /**
     * @param $value
     * @return void
     */
    public function updatedSelectedRoom($value)
    {
        if ($this->selectedRoom) {
            $allTimeslots = Timeslot::where('duration', $this->presentation->type == 'lecture' ? 30 : 80)
                ->get();
            $room = Room::find($this->selectedRoom);

            $timeslotIds = $allTimeslots->filter(function ($timeslot) use ($room) {
                return (new ScheduleController())->checkIfTimeslotAndRoomAreAvailable($room, $timeslot);
            })->pluck('id');

            if ($this->selectedRoom == $this->presentation->room_id) {
                $timeslotIds[] = $this->presentation->timeslot_id;
            }

            if (DefaultPresentation::opening() && DefaultPresentation::closing()) {
                $this->timeslots = Timeslot::whereIn('id', $timeslotIds)
                    ->whereNotIn('id', [
                        DefaultPresentation::opening()->timeslot->id,
                        DefaultPresentation::closing()->timeslot->id
                    ])
                    ->get();
            } else {
                $this->timeslots = Timeslot::whereIn('id', $timeslotIds)->get();
            }

            $this->getMaxParticipants();
        }
    }

    /**
     * @return void
     */
    public function getMaxParticipants(): void
    {
        $this->maxParticipants =
            Room::find($this->selectedRoom)->max_participants < $this->presentation->max_participants
            ? Room::find($this->selectedRoom)->max_participants
            : $this->presentation->max_participants;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetTimeslot()
    {
        $this->presentation->timeslot_id = null;
        $this->presentation->room_id = null;
        $this->presentation->save();

        return redirect()->to(route('moderator.schedule.presentation', $this->presentation));
    }

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.room-and-timeslot-selector');
    }
}

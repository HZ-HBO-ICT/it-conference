<?php

namespace App\Http\Livewire\Rooms;

use App\Models\Room;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteRoomForm extends Component
{

    /**
     * @var Room the Room that must be deleted
     */
    public Room $room;

    /**
     * @var bool determines whether the confirmation modal is visible
     */
    public bool $confirmingRoomDeletion = false;

    /**
     * Trigger the confirmation modal to be visible
     *
     * @return void
     */
    public function confirmRoomDeletion()
    {
        $this->confirmingRoomDeletion = true;
    }

    /**
     * Render the component
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('livewire.rooms.delete-room-form');
    }
}

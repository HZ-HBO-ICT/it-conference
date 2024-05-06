<?php

namespace App\Livewire\Room;

use App\Models\Room;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteRoomModal extends ModalComponent
{
    public Room $room;

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.room.delete-room-modal');
    }
}

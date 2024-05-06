<?php

namespace App\Livewire\Room;

use App\Models\Room;
use LivewireUI\Modal\ModalComponent;

class DeleteRoomModal extends ModalComponent
{
    public Room $room;

    public function render()
    {
        return view('livewire.room.delete-room-modal');
    }
}

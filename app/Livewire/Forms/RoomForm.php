<?php

namespace App\Livewire\Forms;

use App\Models\Room;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RoomForm extends Form
{
    public Room $room;

    #[Validate('required|numeric|min:1')]
    public int $max_participants;

    #[Validate('required')]
    public string $name;

    /**
     * Function that acts as initializer of the form
     * @param $room
     * @return void
     */
    public function setRoom($room)
    {
        $this->room = $room;
        $this->max_participants = $room->max_participants;
        $this->name = $room->name;
    }

    /**
     * Updates the room details with the new data
     * @return void
     */
    public function update()
    {
        $this->room->update(
            $this->all()
        );
    }
}

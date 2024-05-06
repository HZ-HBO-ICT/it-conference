<?php

namespace App\Livewire\Room;

use App\Livewire\Forms\BoothForm;
use App\Livewire\Forms\RoomForm;
use App\Models\Booth;
use App\Models\Room;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditRoomModal extends ModalComponent
{
    public Room $room;
    public RoomForm $form;

    /**
     * Initializes the component
     * @param Room $room
     * @return void
     */
    public function mount(Room $room)
    {
        $this->room = $room;
        $this->form->setRoom($room);
    }

    /**
     * Saves the updates made on the form
     */
    public function save()
    {
        $this->validate();

        $this->form->update();

        return redirect(route('moderator.rooms.show', $this->room))
            ->with('status', 'Rooms successfully updated.');
    }

    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.room.edit-room-modal');
    }
}

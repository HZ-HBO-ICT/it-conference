<?php

namespace App\Http\Livewire\Rooms;

use App\Models\Room;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
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
    public bool $confirmingDeletion = false;

    /**
     * Trigger the confirmation modal to be visible
     *
     * @return void
     */
    public function confirmDeletion()
    {
        $this->confirmingDeletion = true;
    }

    /**
     * Render the component
     *
     * @return View|Factory|Application|ApplicationContract
     */
    public function render(): View|Factory|Application|ApplicationContract
    {
        return view('moderator.rooms.delete-room-form');
    }
}

<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ShowNotification extends Component
{
    public $notification;
    public $text;

    /**
     * Marks notification in the database as read
     * @return void
     */
    public function readNotification()
    {
        $this->notification->markAsRead();
        $this->emitUp('refreshParentComponent');
    }

    /**
     * Triggered when initializing the component
     * @param $notification
     * @return void
     */
    public function mount($notification)
    {
        $this->notification = $notification;
        $this->text = $notification->data['text'];
    }

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.show-notification');
    }
}

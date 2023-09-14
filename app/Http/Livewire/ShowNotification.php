<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowNotification extends Component
{
    public $notification;
    public $text;

    public function readNotification()
    {
        $this->notification->markAsRead();
        $this->emitUp('refreshParentComponent');
    }

    public function mount($notification)
    {
        $this->notification = $notification;
        $this->text = $notification->data['text'];
    }

    public function render()
    {
        return view('livewire.show-notification');
    }
}

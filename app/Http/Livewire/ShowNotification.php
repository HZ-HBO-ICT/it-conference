<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class ShowNotification extends Component
{
    public $notification;
    public $text;

    /**
     * Displays the notification to the user.
     * @return void
     */
    public function readNotification(): void
    {
        $this->notification->markAsRead();
        $this->emitUp('refreshParentComponent');
    }

    /**
     * Sends a notification.
     * @param $notification
     * @return void
     */
    public function mount($notification): void
    {
        $this->notification = $notification;
        $this->text = $notification->data['text'];
    }

    /**
     * Displays the notification element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.show-notification');
    }
}

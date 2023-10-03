<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class NotificationsList extends Component
{
    protected $listeners = ['refreshParentComponent' => '$refresh'];

    public $unreadNotifications;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->refreshNotifications();
    }

    /**
     * Refreshes the notifications on screen.
     * @return void
     */
    public function refreshNotifications(): void
    {
        $this->unreadNotifications = Auth::user()->unreadNotifications;
    }

    /**
     * Renders the notification list element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.notifications-list');
    }
}

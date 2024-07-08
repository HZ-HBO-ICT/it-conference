<?php

namespace App\Livewire;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsList extends Component
{
    protected $listeners = ['refreshParentComponent' => '$refresh'];

    public $unreadNotifications;

    /**
     * Triggered when initializing the component
     * @return void
     */
    public function mount()
    {
        $this->refreshNotifications();
    }

    /**
     * Gets from the database eagerly the new notifications
     * @return void
     */
    public function refreshNotifications()
    {
        $this->unreadNotifications = Auth::user()->unreadNotifications;
    }

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.notifications-list');
    }
}

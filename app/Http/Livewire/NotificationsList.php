<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsList extends Component
{
    protected $listeners = ['refreshParentComponent' => '$refresh'];

    public $unreadNotifications;

    public function mount()
    {
        $this->unreadNotifications = Auth::user()->unreadNotifications;
    }


    public function render()
    {
        return view('livewire.notifications-list');
    }
}

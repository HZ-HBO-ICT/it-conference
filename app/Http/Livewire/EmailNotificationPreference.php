<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailNotificationPreference extends Component
{
    public $receiveEmails;

    public function mount()
    {
        $this->receiveEmails = Auth::user()->receive_emails;
    }

    public function render()
    {
        return view('livewire.email-notification-preference');
    }

    public function save()
    {
        Auth::user()->receive_emails = $this->receiveEmails;
        Auth::user()->save();

        session()->flash('message', 'Email preferences are updated successfully.');
    }
}

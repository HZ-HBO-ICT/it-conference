<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class EmailNotificationPreference extends Component
{
    public $receiveEmails;

    /**
     * Triggered when the component is created
     * @return void
     */
    public function mount()
    {
        $this->receiveEmails = Auth::user()->receive_emails;
    }

    /**
     * Saves the preferences of the user
     * @return void
     */
    public function save()
    {
        Auth::user()->receive_emails = $this->receiveEmails;
        Auth::user()->save();

        session()->flash('message', 'Email preferences are updated successfully.');
    }

    /**
     * Render the component
     * @return View
     */
    public function render()
    {
        return view('livewire.email-notification-preference');
    }
}

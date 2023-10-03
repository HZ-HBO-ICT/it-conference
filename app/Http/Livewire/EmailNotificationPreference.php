<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class EmailNotificationPreference extends Component
{
    public $receiveEmails;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->receiveEmails = Auth::user()->receive_emails;
    }

    /**
     * Renders the notification preference element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.email-notification-preference');
    }

    /**
     * Updates the user's email preferences.
     * @return void
     */
    public function save(): void
    {
        Auth::user()->receive_emails = $this->receiveEmails;
        Auth::user()->save();

        session()->flash('message', 'Email preferences are updated successfully.');
    }
}

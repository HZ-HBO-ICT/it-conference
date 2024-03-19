<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailNotificationPreference extends Component
{
    public $receiveEmails;

    public function mount()
    {
        $this->receiveEmails = Auth::user()->receive_emails;
    }

    /**
     * Renders the component
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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

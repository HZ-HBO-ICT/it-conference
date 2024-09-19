<?php

namespace App\Livewire\QrCode;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Ticket extends Component
{
    /**
     * Renders the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.qr-code.ticket', ['ticket' => Auth::user()->generateExistingTicket()]);
    }
}

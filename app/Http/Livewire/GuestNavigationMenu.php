<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class GuestNavigationMenu extends Component
{
    /**
     * Displays the guest navigation menu.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.guest-navigation-menu');
    }
}

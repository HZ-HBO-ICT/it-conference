<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class AuthNavigationMenu extends Component
{
    /**
     * Displays the navigation menu.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.auth-navigation-menu');
    }
}

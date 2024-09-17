<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class AuthNavigationMenu extends Component
{
    /**
     * Render the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.auth-navigation-menu');
    }
}

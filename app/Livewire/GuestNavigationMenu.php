<?php

namespace App\Livewire;

use Illuminate\Console\Application;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class GuestNavigationMenu extends Component
{
    /**
     * Render the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.guest-navigation-menu');
    }
}

<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class GuestNavigationMenu extends Component
{
    /**
     * Renders the component
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render() : \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('livewire.guest-navigation-menu');
    }
}

<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AuthNavigationMenu extends Component
{
    /**
     * Renders the component
     * @return Application|Factory|View
     */
    public function render() : Application|Factory|View
    {
        return view('livewire.auth-navigation-menu');
    }
}

<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{
    public Authenticatable|User $user;

    /**
     * Triggered when initializing the component
     * @param Authenticatable|User $user
     * @return void
     */
    public function mount(Authenticatable|User $user) : void {
        $this->user = $user;
    }

    /**
     * Return the view for the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.widgets.welcome');
    }
}

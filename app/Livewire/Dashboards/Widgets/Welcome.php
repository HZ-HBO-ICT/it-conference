<?php

namespace App\Livewire\Dashboards\Widgets;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{
    public Authenticatable|User $user;

    public function mount() : void {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.dashboards.widgets.welcome');
    }
}

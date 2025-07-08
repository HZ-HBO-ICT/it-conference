<?php

namespace App\Livewire\Dashboards;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Company extends Component
{
    public Authenticatable|null $user;

    /**
     * Initializes the component
     * @return void
     */
    public function mount() : void
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.dashboards.company');
    }
}

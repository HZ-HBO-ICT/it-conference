<?php

namespace App\Livewire\Dashboards;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Company extends Component
{
    public User $user;

    /**
     * Initializes the component
     * @return void
     */
    public function mount(): void
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            throw new \RuntimeException('Expected Auth::user() to return App\Models\User');
        }

        $this->user = $user;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.company');
    }
}

<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class UserFilteringList extends Component
{
    public $users;

    /**
     * Initializes the component
     *
     * @return void
     */
    public function mount()
    {
        $this->users = User::all()->sortBy('name');
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render() : View
    {
        return view('livewire.users.user-filtering-list');
    }
}

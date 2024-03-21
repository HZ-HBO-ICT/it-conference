<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public User $user;

    public bool $confirmingDeletion = false;

    /**
     * Trigger the confirmation modal to be visible
     *
     * @return void
     */
    public function confirmDeletion()
    {
        $this->confirmingDeletion = true;
    }


    /**
     * Renders the component
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('moderator.users.delete-user-form');
    }
}

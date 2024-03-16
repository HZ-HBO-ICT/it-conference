<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
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


    public function render()
    {
        return view('moderator.users.delete-user-form');
    }
}

<?php

namespace App\Livewire\Crew;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class RevokeRoleOfUser extends ModalComponent
{
    public $user;
    public $role;

    public function mount($user, $role)
    {
        $this->user = User::find($user);
        $this->role = Role::find($role);
    }

    public function confirm()
    {
        $this->user->removeRole($this->role);
        return redirect()->to(route('moderator.crew.index'));
    }

    public function render()
    {
        return view('livewire.crew.revoke-role-of-user');
    }
}

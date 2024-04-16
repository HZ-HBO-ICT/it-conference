<?php

namespace App\Livewire\Company;

use App\Models\User;
use Livewire\Component;

class UpdateMemberRole extends Component
{
    public bool $isOpen = false;

    /**
     * Indicates if a user's role is currently being managed.
     *
     * @var bool
     */
    public $currentlyManagingRole = false;

    /**
     * The user that is having their role managed.
     *
     * @var mixed
     */
    public $managingRoleFor;

    /**
     * The current role for the user that is having their role managed.
     *
     * @var string
     */
    public $currentRole;

    public function mount(User $user)
    {
        $this->managingRoleFor = $user;
        $this->currentRole = $this->managingRoleFor->getRoleNames()->first(function ($name) {
            return $name != 'participant';
        });
        $this->currentlyManagingRole = true;
    }

    public function getRolesProperty()
    {
        return config('roles');
    }

    public function save()
    {
        $this->managingRoleFor->syncRoles(['participant', $this->currentRole]);
        $this->managingRoleFor = $this->managingRoleFor->fresh();

        $this->currentlyManagingRole = false;
        $this->isOpen = false;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->currentRole = '';
    }

    public function render()
    {
        return view('livewire.company.update-member-role');
    }
}

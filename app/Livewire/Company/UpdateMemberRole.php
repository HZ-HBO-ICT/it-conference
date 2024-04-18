<?php

namespace App\Livewire\Company;

use App\Models\User;
use Illuminate\View\View;
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

    /**
     * Called when initializing the component
     * @param User $user
     * @return void
     */
    public function mount(User $user)
    {
        $this->managingRoleFor = $user;
        $this->currentRole = $this->managingRoleFor->getRoleNames()->first(function ($name) {
            return $name != 'participant';
        });
        $this->currentlyManagingRole = true;
    }

    /**
     * Returns all roles and descriptions available
     * @return array
     */
    public function getRolesProperty() : array
    {
        return config('roles');
    }

    /**
     * Saves the new role of the member
     * @return void
     */
    public function save()
    {
        $this->managingRoleFor->syncRoles(['participant', $this->currentRole]);
        $this->managingRoleFor = $this->managingRoleFor->fresh();

        $this->currentlyManagingRole = false;
        $this->isOpen = false;
    }

    /**
     * Closes the modal
     * @return void
     */
    public function close()
    {
        $this->isOpen = false;
        $this->currentRole = '';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.update-member-role');
    }
}

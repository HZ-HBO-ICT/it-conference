<?php

namespace App\Livewire\Crew;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class AssignRoleToUser extends ModalComponent
{
    public $role;
    public $searchValue;
    public $isDropdownVisible;
    public $users;
    public $defaultUsers;
    public $selectedUser;

    /**
     * Initializes component
     *
     * @param $role
     * @return void
     */
    public function mount($role) : void
    {
        if (!Gate::authorize('invite-crew-member')) {
            abort(403);
        }

        $this->role = Role::find($role);
        $this->isDropdownVisible = false;
        $this->defaultUsers = User::withoutRole($role)
            ->doesntHave('company')
            ->orderBy('name')
            ->get();
        $this->users = $this->defaultUsers;
        $this->searchValue = '';
    }

    /**
     * Assigns the role to the user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->selectedUser->assignRole($this->role);
        return redirect()->to(route('moderator.crew.index'));
    }

    /**
     * Triggers the filtering function if the email/name is being changed
     *
     * @return void
     */
    public function updatedSearchValue() : void
    {
        $this->users = $this->defaultUsers;
        if (!empty($this->searchValue)) {
            $this->users = $this->users->filter(function ($user) {
                $nameMatch = stripos($user->name, $this->searchValue) !== false;
                $emailMatch = stripos($user->email, $this->searchValue) !== false;

                return $nameMatch || $emailMatch;
            });
        }
    }

    /**
     * Triggered when the user chooses the assignee
     *
     * @param $id
     * @return void
     */
    public function selectUser($id) : void
    {
        $this->selectedUser = User::find($id);
        $this->searchValue = $this->selectedUser->name;
        $this->updatedSearchValue();
        $this->isDropdownVisible = false;
    }

    /**
     * Responsible for the visibility status of the dropdown
     *
     * @return void
     */
    public function toggleDropdown() : void
    {
        $this->isDropdownVisible = !$this->isDropdownVisible;
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render() : View
    {
        return view('livewire.crew.assign-role-to-user');
    }
}

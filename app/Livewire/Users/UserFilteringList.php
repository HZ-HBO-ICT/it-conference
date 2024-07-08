<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class UserFilteringList extends Component
{
    public $users;
    public $role;
    public $email;
    public $institution;

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
     * Retrieves the users that match the role selected by the user
     *
     * @return void
     */
    public function roleChanged()
    {
        $this->users = User::all()->sortBy('name');

        if ($this->role) {
            $this->users = User::role($this->role)->get()->sortBy('name');
        }
    }

    /**
     * Retrieves the users that match the role selected by the user
     *
     * @return void
     */
    public function updatedInstitution()
    {
        $this->roleChanged();

        if ($this->institution) {
            $this->users = $this->users->filter(function ($user) {
                if ($user->company) {
                    return stripos(optional($user->company)->name, $this->institution) !== false;

                }
                return stripos($user->institution, $this->institution) !== false;
            });
        }
    }

    public function updatedEmail()
    {
        $this->updatedInstitution();

        if ($this->email) {
            $this->users = $this->users->filter(function ($user) {
                $nameMatch = stripos($user->name, $this->email) !== false;
                $emailMatch = stripos($user->email, $this->email) !== false;

                return $nameMatch || $emailMatch;
            });
        }
    }

    public function clearFilters()
    {
        $this->email = '';
        $this->institution = '';
        $this->role='';

        $this->users = User::all()->sortBy('name');
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.users.user-filtering-list');
    }
}

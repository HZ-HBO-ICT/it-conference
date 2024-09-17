<?php

namespace App\Livewire\Company;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class RemoveMember extends Component
{
    public User $user;
    public bool $isOpen = false;

    /**
     * Called when initializing the component
     * @param $user
     * @return void
     */
    public function mount($user)
    {
        $this->user = $user;
    }

    /**
     * Confirms the removal of the team member
     * @return void
     */
    public function confirm()
    {
        $this->user->syncRoles(['participant']);
        $this->user->company_id = null;
        $this->user->save();

        $this->dispatch('user-removed');
        $this->isOpen = false;
    }

    /**
     * Closes the modal
     * @return void
     */
    public function close()
    {
        $this->isOpen = false;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.company.remove-member');
    }
}

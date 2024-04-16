<?php

namespace App\Livewire\Company;

use App\Models\User;
use Livewire\Component;

class RemoveMember extends Component
{
    public User $user;
    public bool $isOpen = false;

    public function mount($user) {
        $this->user = $user;
    }

    public function confirm(){
        $this->user->syncRoles(['participant']);
        $this->user->company_id = null;
        $this->user->save();

        $this->dispatch('user-removed');
        $this->isOpen = false;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.company.remove-member');
    }
}

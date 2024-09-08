<?php

namespace App\Livewire\Crew;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class RevokeRoleOfUser extends ModalComponent
{
    public $user;
    public $role;

    /**
     * Initializes a component
     * @param $user
     * @param $role
     * @return void
     */
    public function mount($user, $role)
    {
        if (!Gate::authorize('remove-crew-member')) {
            abort(403);
        }

        $this->user = User::find($user);
        $this->role = Role::find($role);
    }

    /**
     * Triggered when the action is confirmed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm()
    {
        $this->user->removeRole($this->role);
        return redirect()->to(route('moderator.crew.index'));
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.crew.revoke-role-of-user');
    }
}

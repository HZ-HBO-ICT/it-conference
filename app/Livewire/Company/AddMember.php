<?php

namespace App\Livewire\Company;

use App\Mail\CustomTeamInvitation;
use App\Models\Company;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddMember extends Component
{
    public Company $company;

    #[Validate('required|unique:users')]
    public string $email;
    #[Validate('required')]
    public string $currentRole;

    public function mount($company)
    {
        $this->company = $company;
    }

    /**
     * Invite a new team member to the given team.
     */
    public function invite(): void
    {
        $this->validate();

        $invitation = $this->company->invitations()->create([
            'email' => $this->email,
            'role' => $this->currentRole,
        ]);

        Mail::to($this->email)->send(new CustomTeamInvitation($invitation));

        $this->currentRole = '';
        $this->email = '';

        $this->company = $this->company->refresh();
    }

    public function getRolesProperty()
    {
        return config('roles');
    }

    public function cancelTeamInvitation($invitation_id)
    {
        $invitation = Invitation::find($invitation_id);
        $invitation->delete();

        $this->company = $this->company->refresh();
    }

    public function render()
    {
        return view('livewire.company.add-member');
    }
}

<?php

namespace App\Livewire\Company;

use App\Mail\CustomCompanyInvitation;
use App\Models\Company;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddMember extends Component
{
    public Company $company;

    #[Validate('required|unique:users')]
    public string $email;

    /**
     * Called when initializing the component
     * @param $company
     * @return void
     */
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
            'role' => 'company member'
        ]);

        Mail::to($this->email)->send(new CustomCompanyInvitation($invitation));

        $this->email = '';

        $this->company = $this->company->refresh();
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
     * Cancels the company invitation that was sent
     * @param $invitation_id
     * @return void
     */
    public function cancelInvitation($invitation_id)
    {
        $invitation = Invitation::find($invitation_id);
        $invitation->delete();

        $this->company = $this->company->refresh();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.add-member');
    }
}

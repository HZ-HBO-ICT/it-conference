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
    public $roles;

    #[Validate('required|in:speaker,booth owner,company member')]
    public $currentRole;

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
        $this->roles = [
            'speaker' => 'The user can request to give a presentation or become a co-speaker for another presentation
            within the company.',
            'booth owner' => 'The user can request a booth if one does not already exist and is expected to be present
            at the booth during the conference.',
            'company member' => 'The user can choose to be a speaker or a booth owner. If they do not take action to
            become a speaker or booth owner, they will simply accompany the other members.'
        ];
    }

    /**
     * Handles the selecting of a new role
     *
     * @param $role
     * @return void
     */
    public function selectRole($role)
    {
        $this->currentRole = $role;
    }


    /**
     * Invite a new team member to the given team.
     */
    public function invite(): void
    {
        $this->validate();
        if ($this->currentRole == 'speaker') {
            $this->currentRole = 'pending speaker';
        } elseif ($this->currentRole == 'booth owner') {
            $this->currentRole = 'pending booth owner';
        }

        $invitation = $this->company->invitations()->create([
            'email' => $this->email,
            'role' => $this->currentRole
        ]);

        Mail::to($this->email)->send(new CustomCompanyInvitation($invitation));

        $this->email = '';
        $this->currentRole = '';

        $this->company = $this->company->refresh();
        session()->flash('message', 'Post successfully updated.');
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
    public function render(): View
    {
        return view('livewire.company.add-member');
    }
}

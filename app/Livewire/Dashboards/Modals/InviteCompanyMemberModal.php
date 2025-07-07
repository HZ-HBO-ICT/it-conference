<?php

namespace App\Livewire\Dashboards\Modals;

use App\Mail\CustomCompanyInvitation;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class InviteCompanyMemberModal extends ModalComponent
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
     * @return void
     */
    public function invite(): void
    {
        $this->authorize('update', $this->company);

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

        Toaster::success('Company member was invited successfully!');

        $this->closeModal();
    }

    /**
     * Resets the modal
     * @return void
     */
    public function cancel() : void
    {
        $this->email = '';
        $this->currentRole = '';
        $this->closeModal();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.modals.invite-company-member-modal');
    }
}

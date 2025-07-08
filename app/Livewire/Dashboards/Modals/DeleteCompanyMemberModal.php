<?php

namespace App\Livewire\Dashboards\Modals;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class DeleteCompanyMemberModal extends ModalComponent
{
   public User|Invitation $member;
   public bool $isInvitation = false;

    /**
     * Initializes the component
     * @param int $id
     * @param bool $isInvitation
     * @return void
     */
    public function mount(int $id, bool $isInvitation) : void
    {
        $this->isInvitation = $isInvitation;

        if ($this->isInvitation) {
            $this->member = Invitation::find($id);
        } else {
            $this->member = User::find($id);
        }
    }

    /**
     * Deletes the member
     * @return void
     * @throws AuthorizationException
     */
    public function delete() : void
    {
        $this->authorize('update', $this->member->company);

        $this->member->delete();
        $this->dispatch('updated-dashboard');

        Toaster::success('Company member was deleted successfully!');

        $this->closeModal();
    }

    /**
     * Cancels the action
     * @return void
     */
    public function cancel() : void {
        $this->closeModal();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.modals.delete-company-member-modal');
    }
}

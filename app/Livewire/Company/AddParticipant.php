<?php

namespace App\Livewire\Company;

use App\Actions\Users\AddParticipantToCompanyHandler;
use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class AddParticipant extends ModalComponent
{
    public $company;
    public $searchValue;
    public $isDropdownVisible;
    public $users;
    public $defaultUsers;
    public $selectedUser;
    public $canAssignRole;
    public $assignedRole;

    /**
     * Initializes the component
     * @return void
     */
    public function mount($companyId)
    {
        $this->company = Company::find($companyId);
        $this->searchValue = '';
        $this->defaultUsers = User::role('participant')
            ->whereNull('company_id')
            ->get()
            ->filter(function ($user) {
                return $user->hasExactRoles('participant');
            });
        $this->users = $this->defaultUsers;
        $this->isDropdownVisible = false;
        $this->canAssignRole = false;
        $this->assignedRole = 'company member';
    }

    /**
     * Triggers the filtering function if the email/name is being changed
     *
     * @return void
     */
    public function updatedSearchValue(): void
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
     * Assigns the participant to a company or handles the failure of assigning
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function save()
    {
        try {
            (new AddParticipantToCompanyHandler())->execute($this->selectedUser, $this->company, $this->assignedRole);
            return redirect()->to(route('moderator.companies.show', $this->company));
        } catch (Exception $exception) {
            Toaster::error($exception->getMessage());
        }
    }

    /**
     * Triggered when the user chooses the assignee
     *
     * @param $id
     * @return void
     */
    public function selectUser($id): void
    {
        $this->selectedUser = User::find($id);
        $this->searchValue = $this->selectedUser->name;
        $this->updatedSearchValue();
        $this->isDropdownVisible = false;

        $this->canAssignRole = is_null($this->selectedUser->presenter_of);
    }

    /**
     * Responsible for the visibility status of the dropdown
     *
     * @return void
     */
    public function toggleDropdown(): void
    {
        $this->isDropdownVisible = !$this->isDropdownVisible;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.company.add-participant');
    }
}

<?php

namespace App\Livewire\Booth;

use App\Livewire\Forms\BoothForm;
use App\Models\Booth;
use App\Models\Company;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateBooth extends Component
{
    #[Validate(['required', 'numeric', 'min:1', 'max:10'])]
    public $width;

    #[Validate(['required', 'numeric', 'min:1', 'max:10'])]
    public $length;

    #[Validate(['nullable', 'max:255'])]
    public $additionalInformation;

    public $company;
    public $companies;
    public $companyId;

    public $searchValue;
    public $isDropdownVisible;
    public $users;
    public $selectedUser;

    public function mount(){
        $this->companies = Company::whereDoesntHave('booth')->where('is_approved', '=', '1')->get();
        $this->company = $this->companies->first();
        $this->isDropdownVisible = false;
        $this->users = optional($this->company)->users;
        $this->searchValue = '';
    }

    /**
     * Creates the entity
     * @return void
     */
    public function save() {
        $this->validate();

        $this->validate([
            'company' => 'required',
            'selectedUser' => 'required'
        ]);

        $boothData = [
            'width' => $this->width,
            'length' => $this->length,
            'additional_information' => $this->additionalInformation,
            'company_id' => $this->company->id,
            'is_approved' => true
        ];

        Booth::create($boothData);

        $this->selectedUser->assignRole('booth owner');

        if($this->selectedUser->hasRole('pending booth owner')) {
            $this->selectedUser->removeRole('pending booth owner');
        }

        $this->redirect(route('moderator.booths.index'));
    }

    /**
     * Triggers the filtering function if the email/name is being changed
     *
     * @return void
     */
    public function updatedSearchValue() : void
    {
        $this->users = $this->company->users;
        if (!empty($this->searchValue)) {
            $this->users = $this->users->filter(function ($user) {
                $nameMatch = stripos($user->name, $this->searchValue) !== false;
                $emailMatch = stripos($user->email, $this->searchValue) !== false;

                return $nameMatch || $emailMatch;
            });
        }
    }

    public function updatedCompanyId() : void {
        $this->company = Company::find($this->companyId);
        $this->users = $this->company->users;
        $this->searchValue = '';
        $this->updatedSearchValue();
        $this->selectedUser = null;
        $this->isDropdownVisible = false;
    }

    /**
     * Triggered when the user chooses the assignee
     *
     * @param $id
     * @return void
     */
    public function selectUser($id) : void
    {
        $this->selectedUser = User::find($id);
        $this->searchValue = $this->selectedUser->name;
        $this->updatedSearchValue();
        $this->isDropdownVisible = false;
    }

    /**
     * Responsible for the visibility status of the dropdown
     *
     * @return void
     */
    public function toggleDropdown() : void
    {
        $this->isDropdownVisible = !$this->isDropdownVisible;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.booth.create-booth');
    }
}

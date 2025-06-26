<?php

namespace App\Livewire\Dashboards\Modals;

use App\Livewire\Forms\CompanyForm;
use App\Models\Company;
use LivewireUI\Modal\ModalComponent;

class CompanyDetailsModal extends ModalComponent
{
    public Company $company;
    public CompanyForm $form;

    public $editing = false;

    /**
     * Triggered on initializing of the component
     * @param Company $company
     * @return void
     */
    public function mount(Company $company)
    {
        $this->company = $company;
        $this->form->setCompany($company);
    }

    public function save() {

    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function render()
    {
        return view('livewire.dashboards.modals.company-details-modal');
    }
}

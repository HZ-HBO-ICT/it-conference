<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteCompanyModal extends ModalComponent
{
    public Company $company;

    public function render()
    {
        return view('livewire.company.delete-company-modal');
    }
}

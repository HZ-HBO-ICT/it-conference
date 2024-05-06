<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteCompanyModal extends ModalComponent
{
    public Company $company;

    /**
     * Renders the component
     * @return View
     */
    public function render()
    {
        return view('livewire.company.delete-company-modal');
    }
}

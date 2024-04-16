<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class DeleteCompany extends Component
{
    public Company $company;

    public function mount($company)
    {
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.company.delete-company');
    }
}

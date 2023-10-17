<?php

namespace App\Http\Livewire\Companies;

use App\Models\Team;
use Livewire\Component;

class DeleteCompanyForm extends Component
{
    public Team $company;

    public bool $confirmingDeletion = false;

    /**
     * Trigger the confirmation modal to be visible
     *
     * @return void
     */
    public function confirmDeletion()
    {
        $this->confirmingDeletion = true;
    }


    public function render()
    {
        return view('moderator.companies.delete-company-form');
    }
}

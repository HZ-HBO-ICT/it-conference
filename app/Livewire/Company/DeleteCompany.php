<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Illuminate\View\View;
use Livewire\Component;

class DeleteCompany extends Component
{
    public Company $company;

    /**
     * Called when initializing the component
     * @param $company
     * @return void
     */
    public function mount($company)
    {
        $this->company = $company;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.delete-company');
    }
}

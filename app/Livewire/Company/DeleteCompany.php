<?php

namespace App\Livewire\Company;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteCompany extends Component
{

    public $company;

    /**
     * Triggered when initializing the component
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

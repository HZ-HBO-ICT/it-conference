<?php

namespace App\Livewire\Company;

use Illuminate\View\View;
use Livewire\Component;

class DetailsForm extends Component
{
    public $company;
    public $representative;

    /**
     * Called when the component is initialized
     * @param $company
     * @return void
     */
    public function mount($company)
    {
        $this->company = $company;
        $this->representative;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.company.details-form');
    }
}

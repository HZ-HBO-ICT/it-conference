<?php

namespace App\Livewire\Company;

use Livewire\Component;

class DetailsForm extends Component
{
    public $company;
    public $representative;

    public function mount($company){
        $this->company = $company;
        $this->representative;
    }

    public function render()
    {
        return view('livewire.company.details-form');
    }
}

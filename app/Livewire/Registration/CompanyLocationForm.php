<?php

namespace App\Livewire\Registration;

use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyLocationForm extends Component
{
    #[Validate(
        'required',
        'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'
    )]
    public string $companyPostcode;

    #[Validate(['required',
        'regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'])]
    public string $companyHouseNumber;

    #[Validate(['required', 'string'])]
    public string $companyStreet;

    #[Validate(['required', 'string'])]
    public string $companyCity;

    #[Validate(['accepted', 'required'])]
    public $terms;

    /**
     * Dispatches an event to the parent component to go back
     * @return void
     */
    public function goBack()
    {
        $this->dispatch('go-back', formName: 'CompanyLocationInfoForm');
    }

    /**
     * Dispatches an event to the parent to go next
     * @return void
     */
    public function goNext()
    {
        $this->validate();

        $this->dispatch('go-next', formName: 'CompanyLocationInfoForm', input: [
            'company_postcode' => $this->companyPostcode,
            'company_house_number' => $this->companyHouseNumber,
            'company_street' => $this->companyStreet,
            'company_city' => $this->companyCity,
            'terms' => $this->terms
        ]);
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.registration.company-location-form');
    }
}

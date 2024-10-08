<?php

namespace App\Livewire\Forms;

use App\Models\Company;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CompanyForm extends Form
{
    public Company $company;

    #[Validate('required')]
    public string $name;

    #[Validate('required')]
    public string $description;

    #[Validate('required')]
    public string $website;

    #[Validate('required|phone:INTERNATIONAL, NL')]
    public string $phone_number;

    #[Validate(['required','regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'])]
    public string $postcode;

    #[Validate(['required','regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'])]
    public string $house_number;

    #[Validate('required')]
    public string $street;

    #[Validate('required')]
    public string $city;

    /**
     * Sets the company details per each field
     * @param Company $company
     * @return void
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;

        $this->name = $company->name;
        $this->description = $company->description;
        $this->website = $company->website;
        $this->phone_number = $company->phone_number;
        $this->postcode = $company->postcode;
        $this->house_number = $company->house_number;
        $this->street = $company->street;
        $this->city = $company->city;
    }

    /**
     * Updates the company details with the new data
     * @return void
     */
    public function update()
    {
        $this->company->update(
            $this->all()
        );
    }
}

<?php

namespace App\Livewire\Registration;

use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyBasicForm extends Component
{
    #[Validate(['required', 'string'])]
    public string $companyName;

    #[Validate(['required', 'string'])]
    public string $companyDescription;

    #[Validate(['required', 'string'])]
    public string $companyWebsite;

    #[Validate('phone:INTERNATIONAL,NL', message: 'Invalid phone number')]
    #[Validate('required')]
    public string $companyPhoneNumber;

    public function goBack()
    {
        $this->dispatch('go-back', formName: 'CompanyBasicInfoForm');
    }

    public function goNext()
    {
        $this->validate();

        $this->dispatch('go-next', formName: 'CompanyBasicInfoForm', input: [
            'company_name' => $this->companyName,
            'company_description' => $this->companyDescription,
            'company_phone_number' => $this->companyPhoneNumber,
            'company_website' => $this->companyWebsite
        ]);
    }

    public function render()
    {
        return view('livewire.registration.company-basic-form');
    }
}

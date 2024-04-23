<?php

namespace App\Livewire\Registration;

use Livewire\Attributes\On;
use Livewire\Component;

class ParentComponent extends Component
{
    public bool $showChooseRole = true;
    public bool $showParticipantForm = false;
    public bool $showCompanyRepresentativeForm = false;
    public bool $showCompanyBasicInfoForm = false;
    public bool $showCompanyLocationInfoForm = false;
    private array $participantInput = [];
    private array $companyRepresentativeInput = [];
    private array $companyBasicInfoInput = [];
    private array $companyLocationInfoInput = [];

    #[On('go-next')]
    public function handleGoingNext($formName, $input)
    {
        if ($formName == 'ParticipantForm') {
            //registration
        } elseif ($formName == 'CompanyRepresentativeForm') {
            $this->showChooseRole = true;
            $this->showCompanyRepresentativeForm = false;
        } elseif ($formName == 'CompanyBasicInfoForm') {
            $this->showCompanyRepresentativeForm = false;
            $this->showCompanyBasicInfoForm = true;
        } elseif ($formName == 'CompanyLocationInfoForm') {
            $this->showCompanyLocationInfoForm = true;
            $this->showCompanyBasicInfoForm = false;
        }
    }

    #[On('go-back')]
    public function handleGoingBack($formName)
    {
        if ($formName == 'ParticipantForm') {
            $this->showParticipantForm = false;
            $this->showChooseRole = true;
        } elseif ($formName == 'CompanyRepresentativeForm') {
            $this->showChooseRole = true;
            $this->showCompanyRepresentativeForm = false;
        } elseif ($formName == 'CompanyBasicInfoForm') {
            $this->showCompanyRepresentativeForm = false;
            $this->showCompanyBasicInfoForm = true;
        } elseif ($formName == 'CompanyLocationInfoForm') {
            $this->showCompanyLocationInfoForm = true;
            $this->showCompanyBasicInfoForm = false;
        }
    }

    public function render()
    {
        return view('livewire.registration.parent-component');
    }
}

<?php

namespace App\Livewire\Registration;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ParentComponent extends Component
{
    public bool $showCompanyRepresentativeForm = true;
    public bool $showCompanyBasicInfoForm = false;
    public bool $showCompanyLocationInfoForm = false;
    public array $companyRepresentativeInput = [];
    public array $companyBasicInfoInput = [];

    #[On('go-next')]
    public function handleGoingNext($formName, $input)
    {
        if ($formName == 'CompanyRepresentativeForm') {
            $this->showCompanyRepresentativeForm = false;
            $this->showCompanyBasicInfoForm = true;
            $this->companyRepresentativeInput = $input;
        } elseif ($formName == 'CompanyBasicInfoForm') {
            $this->showCompanyBasicInfoForm = false;
            $this->showCompanyLocationInfoForm = true;
            $this->companyBasicInfoInput = $input;
        } elseif ($formName == 'CompanyLocationInfoForm') {
            $userInput = array_merge($this->companyRepresentativeInput,
                $this->companyBasicInfoInput,
                $input);
            $this->register($userInput);
        }
    }

    #[On('go-back')]
    public function handleGoingBack($formName)
    {
        if ($formName == 'CompanyBasicInfoForm') {
            $this->showCompanyRepresentativeForm = true;
            $this->showCompanyBasicInfoForm = false;
        } elseif ($formName == 'CompanyLocationInfoForm') {
            $this->showCompanyLocationInfoForm = true;
            $this->showCompanyBasicInfoForm = false;
        }
    }

    public function register($input)
    {
        event(new Registered($user = app(CreateNewUser::class)->create($input)));

        Auth::guard()->login($user);

        $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.registration.parent-component');
    }
}

<?php

namespace App\Livewire\Registration;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Current order of the forms:
 * 1) Company Representative Details
 * 2) Basic Company Details
 * 3) Motivation for Attending
 * 4) Company Internship Details
 * 5) Company Location Details
 */
class ParentComponent extends Component
{
    public bool $showCompanyRepresentativeForm = true;
    public bool $showCompanyBasicInfoForm = false;
    public bool $showCompanyInternshipsInfoForm = false;
    public bool $showCompanyMotivationInfoForm = false;
    public bool $showCompanyLocationInfoForm = false;
    public array $companyRepresentativeInput = [];
    public array $companyBasicInfoInput = [];
    public array $companyInternshipsInfoInput = [];
    public array $companyMotivationInfoInput = [];

    /**
     * Handles the change of the wizard's forms
     * @param $formName string The current form
     * @param $input
     * @return void
     */
    #[On('go-next')]
    public function handleGoingNext($formName, $input)
    {
        if ($formName == 'CompanyRepresentativeForm') {
            $this->showCompanyRepresentativeForm = false;
            $this->showCompanyBasicInfoForm = true;
            $this->companyRepresentativeInput = $input;
        } elseif ($formName == 'CompanyBasicInfoForm') {
            $this->showCompanyBasicInfoForm = false;
            $this->showCompanyMotivationInfoForm = true;
            $this->companyBasicInfoInput = $input;
        } elseif ($formName == 'CompanyMotivationInfoForm') {
            $this->showCompanyMotivationInfoForm = false;
            $this->showCompanyInternshipsInfoForm = true;
            $this->companyMotivationInfoInput = $input;
        } elseif ($formName == 'CompanyInternshipsInfoForm') {
            $this->showCompanyInternshipsInfoForm = false;
            $this->showCompanyLocationInfoForm = true;
            $this->companyInternshipsInfoInput = $input;
        } elseif ($formName == 'CompanyLocationInfoForm') {
            $userInput = array_merge(
                $this->companyRepresentativeInput,
                $this->companyBasicInfoInput,
                $this->companyInternshipsInfoInput,
                $this->companyMotivationInfoInput,
                $input
            );
            $this->register($userInput);
        }
    }

    /**
     * Handles the going back in the form
     * @param $formName string The form that is opened currently
     * @return void
     */
    #[On('go-back')]
    public function handleGoingBack($formName)
    {
        if ($formName == 'CompanyBasicInfoForm') {
            $this->showCompanyRepresentativeForm = true;
            $this->showCompanyBasicInfoForm = false;
        } elseif ($formName == 'CompanyMotivationInfoForm') {
            $this->showCompanyBasicInfoForm = true;
            $this->showCompanyMotivationInfoForm = false;
        } elseif ($formName == 'CompanyInternshipsInfoForm') {
            $this->showCompanyMotivationInfoForm = true;
            $this->showCompanyInternshipsInfoForm = false;
        } elseif ($formName == 'CompanyLocationInfoForm') {
            $this->showCompanyInternshipsInfoForm = true;
            $this->showCompanyLocationInfoForm = false;
        }
    }

    /**
     * Handles the registration
     * @param $input
     * @return void
     */
    public function register($input)
    {
        event(new Registered($user = app(CreateNewUser::class)->create($input)));

        Auth::guard()->login($user);

        $this->redirect(route('dashboard'));
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.registration.parent-component');
    }
}

<?php

namespace App\Livewire\Registration;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyRepresentativeForm extends Component
{
    use PasswordValidationRules;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name;

    #[Validate(['required', 'string', 'email', 'max:255', 'unique:users'])]
    public string $email;

    #[Validate(['required', 'min:12', 'string'])]
    public string $password = '';

    #[Validate('required', 'min:12', 'string')]
    public string $password_confirmation;

    /**
     * Dispatches an event to the parent component to go back
     * @return void
     */
    public function goBack()
    {
        $this->dispatch('go-back', formName: 'CompanyRepresentativeForm');
    }


    /**
     * Dispatches an event to the parent to go next
     * @return void
     */
    public function goNext()
    {
        $this->validate();

        $this->validate([
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required']);

        $this->dispatch('go-next', formName: 'CompanyRepresentativeForm', input: [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'registration_type' => 'company_representative'

        ]);
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.registration.company-representative-form');
    }
}

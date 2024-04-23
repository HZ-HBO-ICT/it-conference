<?php

namespace App\Livewire\Registration;

use App\Actions\Fortify\PasswordValidationRules;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyRepresentativeForm extends Component
{
    use PasswordValidationRules;

    #[Validate('required')]
    public string $name;

    #[Validate(['required', 'unique:users'])]
    public string $email;

    #[Validate(['required', 'min:12', 'string'])]
    public string $password = '';

    #[Validate('required', 'min:12', 'string')]
    public string $password_confirmation;

    public function goBack()
    {
        $this->dispatch('go-back', formName: 'CompanyRepresentativeForm');
    }

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
            'confirm_password' => $this->password_confirmation
        ]);
    }

    public function render()
    {
        return view('livewire.registration.company-representative-form');
    }
}

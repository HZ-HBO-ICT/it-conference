<?php

namespace App\Livewire\Registration;

use Livewire\Attributes\Validate;
use Livewire\Component;

class ParticipantForm extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $name;

    #[Validate(['required', 'string', 'email', 'max:255', 'unique:users'])]
    public string $email;

    #[Validate(['required', 'string'])]
    public string $institution;

    #[Validate(['required', 'min:12', 'string'])]
    public string $password = '';

    #[Validate('required', 'min:12', 'string')]
    public string $password_confirmation;

    #[Validate(['accepted', 'required'])]
    public $terms;

    public function goBack()
    {
        $this->dispatch('go-back', formName: 'ParticipantForm');
    }

    public function goNext()
    {
        $this->validate();

        $this->dispatch('go-next', formName: 'ParticipantForm', input: [
            'name' => $this->name,
            'email' => $this->email,
            'institution' => $this->institution,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'terms' => $this->terms
        ]);
    }

    public function render()
    {
        return view('livewire.registration.participant-form');
    }
}

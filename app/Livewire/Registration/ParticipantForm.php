<?php

namespace App\Livewire\Registration;

use Livewire\Component;

class ParticipantForm extends Component
{
    public function goBack()
    {
        $this->dispatch('go-back', formName: 'ParticipantForm');
    }

    public function render()
    {
        return view('livewire.registration.participant-form');
    }
}

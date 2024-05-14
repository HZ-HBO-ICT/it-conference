<?php

namespace App\Livewire\Schedule;

use Livewire\Component;

class Presentation extends Component
{
    public $presentation;

    public function mount($presentation)
    {
        $this->presentation = $presentation;
    }

    public function render()
    {
        return view('livewire.schedule.presentation');
    }
}

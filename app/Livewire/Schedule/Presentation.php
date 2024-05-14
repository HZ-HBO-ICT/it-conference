<?php

namespace App\Livewire\Schedule;

use Livewire\Component;

class Presentation extends Component
{
    public $presentation;
    public $height;

    public function mount($presentation)
    {
        $this->presentation = $presentation;
        $this->height = $this->calculateHeightInREM();
    }

    protected function calculateHeightInREM()
    {
        $duration = $this->presentation->type == 'workshop'
            ? \App\Models\Presentation::$WORKSHOP_DURATION
            : \App\Models\Presentation::$LECTURE_DURATION;

        return $duration * (14 / 30) * 0.25;
    }

    public function render()
    {
        return view('livewire.schedule.presentation');
    }
}

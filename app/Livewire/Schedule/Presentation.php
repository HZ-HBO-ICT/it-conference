<?php

namespace App\Livewire\Schedule;

use Livewire\Component;

class Presentation extends Component
{
    public $presentation;
    public $height;
    public $details;
    public $colors;

    public function mount($presentation)
    {
        $this->presentation = $presentation;
        $this->height = $this->calculateHeightInREM();
        $this->details = $this->getDetails();
        $this->colors = $this->getColors();
    }

    protected function calculateHeightInREM()
    {
        $duration = $this->presentation->type == 'workshop'
            ? \App\Models\Presentation::$WORKSHOP_DURATION
            : \App\Models\Presentation::$LECTURE_DURATION;

        return $duration * (14 / 30) * 0.25;
    }

    protected function getDetails()
    {
        return is_null($this->presentation->company)
            ? $this->presentation->speakers->first()->name
            : $this->presentation->company->name;
    }

    protected function getColors()
    {
        if ($this->presentation->company) {
            if ($this->presentation->company->isSponsor) {
                return 'bg-' . $this->presentation->company->sponsorship->name;
            }
        }

        return 'bg-crew-500';
    }

    public function render()
    {
        return view('livewire.schedule.presentation');
    }
}

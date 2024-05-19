<?php

namespace App\Livewire\Schedule;

use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Presentation extends Component
{
    public $id;
    public $presentation;
    public $height;
    public $marginTop;
    public $details;
    public $colors;

    public function mount($presentation)
    {
        $this->presentation = $presentation;
        $this->id = $this->presentation->id;
        $this->height = $this->calculateHeightInREM();
        $this->marginTop = $this->calculateMarginTopInREM();
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

    protected function calculateMarginTopInREM()
    {
        $presentationStart = Carbon::parse($this->presentation->start);
        $timeslotStart = Carbon::parse($this->presentation->timeslot->start);

        $diff = $timeslotStart->copy()->diffInMinutes($presentationStart);

        return $diff * (14 / 30) * 0.25;
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

    #[On("update-presentation-{id}")]
    public function refresh() {
        $this->presentation = $this->presentation->fresh();
        $this->height = $this->calculateHeightInREM();
        $this->marginTop = $this->calculateMarginTopInREM();
    }

    public function render()
    {
        return view('livewire.schedule.presentation');
    }
}

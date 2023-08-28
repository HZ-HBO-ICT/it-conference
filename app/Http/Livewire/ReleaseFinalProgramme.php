<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Livewire\Component;

class ReleaseFinalProgramme extends Component
{
    public $isOpen = false;

    public $numberOfUnscheduledPresentations;

    public function mount()
    {
        $this->numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();
    }

    public function render()
    {
        return view('livewire.release-final-programme');
    }
}

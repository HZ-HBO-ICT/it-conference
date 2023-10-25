<?php

namespace App\Http\Livewire\Schedule;

use Livewire\Component;

class AddTimeslotPadding extends Component
{
    public $isModalOpen = false;

    public function render()
    {
        return view('moderator.schedule.add-timeslot-padding');
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }
}

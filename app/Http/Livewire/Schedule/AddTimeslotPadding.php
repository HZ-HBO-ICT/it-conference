<?php

namespace App\Http\Livewire\Schedule;

use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;
use Symfony\Component\Console\Application;

class AddTimeslotPadding extends Component
{
    public $isModalOpen = false;

    /**
     * Renders the component
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render()
    {
        return view('moderator.schedule.timeslots.add-timeslot-padding');
    }

    /**
     * Opens the modal within the view part of the component
     * @return void
     */
    public function openModal()
    {
        $this->isModalOpen = true;
    }
}

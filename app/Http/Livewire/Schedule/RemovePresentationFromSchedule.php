<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Presentation;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;
use Symfony\Component\Console\Application;

class RemovePresentationFromSchedule extends Component
{
    public Presentation $presentation;

    /**
     * Renders the component
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render() : View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('moderator.schedule.presentations.remove-presentation-from-schedule');
    }

    /**
     * Removes presentation from a timeslot
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->presentation->room_id = null;
        $this->presentation->timeslot_id = null;
        $this->presentation->save();

        $this->presentation->participants()->detach();

        return redirect()->to(route('moderator.schedule.overview'));
    }
}

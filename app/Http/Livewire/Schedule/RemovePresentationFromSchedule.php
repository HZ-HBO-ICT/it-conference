<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Presentation;
use Livewire\Component;

class RemovePresentationFromSchedule extends Component
{
    public Presentation $presentation;

    public function render()
    {
        return view('moderator.schedule.remove-presentation-from-schedule');
    }

    public function remove()
    {
        $this->presentation->room_id = null;
        $this->presentation->timeslot_id = null;
        $this->presentation->save();

        $this->presentation->participants()->detach();

        return redirect()->to(route('moderator.schedule.overview'));
    }
}

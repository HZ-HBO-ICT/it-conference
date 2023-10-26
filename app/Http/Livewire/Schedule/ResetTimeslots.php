<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Presentation;
use App\Models\Timeslot;
use Livewire\Component;

class ResetTimeslots extends Component
{
    public $isOpen = false;

    public function confirm()
    {
        $presentations = Presentation::all();
        foreach ($presentations as $presentation) {
            $presentation->timeslot_id = null;
            $presentation->room_id = null;
            $presentation->save();
        }

        // TODO: After refactoring the constraints, this can be switched to truncate
        Timeslot::where('id', '>', 0)->delete();
        $this->redirect(route('moderator.schedule.timeslots.create'));
    }

    public function render()
    {
        return view('moderator.schedule.timeslots.reset-timeslots');
    }
}

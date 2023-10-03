<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use App\Models\Timeslot;
use Illuminate\View\View;
use Livewire\Component;
use Ramsey\Uuid\Type\Time;

class ResetTimeslots extends Component
{
    public $isOpen = false;

    /**
     * Function to confirm a timeslot.
     * @return void
     */
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

    /**
     * Function that renders the reset-timeslots element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.reset-timeslots');
    }
}

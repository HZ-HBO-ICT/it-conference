<?php

namespace App\Livewire\Schedule;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\Sponsorship;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class GridParentComponent extends Component
{
    public $rooms;
    public $timeslots;
    public $unscheduledPresentations;
    public $lectureCount;
    public $workshopCount;

    /**
     * Initializes the component
     * @return void
     */
    public function mount()
    {
        $this->rooms = Room::all();
        $this->timeslots = Timeslot::all();

        $this->unscheduledPresentations = Presentation::where(function ($presentation) {
            return $presentation->whereNull(['timeslot_id', 'room_id', 'start']);
        })->get()->where('is_approved', '=', 1);

        $this->lectureCount = $this->unscheduledPresentations->where('type', 'lecture')->count();
        $this->workshopCount = $this->unscheduledPresentations->where('type', 'workshop')->count();
    }

    /**
     * Listens for a moving event sent by the children (cells) to relocate presentations
     * and dispatches an event to the children to update
     * @param $data
     * @return void
     */
    #[On('move-presentation')]
    public function proccessMovingPresentation($data)
    {
        $presentation = Presentation::find($data['presentation_id']);
        $oldRoom = $presentation->room;
        $oldTimeslot = $presentation->timeslot;

        $presentation->update([
            'room_id' => $data['new_room_id'],
            'timeslot_id' => $data['new_timeslot_id'],
            'start' => $data['new_time']
        ]);
        $presentation->save();
        $presentation->refresh();

        if ($oldRoom && $oldTimeslot) {
            $this->dispatch("update-cell-r-{$oldRoom->id}-t-{$oldTimeslot->id}");
        } else {
            $this->unscheduledPresentations = Presentation::where(function ($presentation) {
                return $presentation->whereNull(['timeslot_id', 'room_id', 'start']);
            })->get()->where('is_approved', '=', 1);
        }

        $this->lectureCount = $this->unscheduledPresentations->where('type', 'lecture')->count();
        $this->workshopCount = $this->unscheduledPresentations->where('type', 'workshop')->count();
        $this->dispatch("update-cell-r-{$presentation->room->id}-t-{$presentation->timeslot->id}");
        $this->dispatch("check-programme-status");
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.schedule.grid-parent-component');
    }
}

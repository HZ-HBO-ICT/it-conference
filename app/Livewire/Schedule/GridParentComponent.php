<?php

namespace App\Livewire\Schedule;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\Sponsorship;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
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
        $this->refreshUnscheduledPresentations();
    }

    /**
     * Fetches the data for the unscheduled presentations from the database
     *
     * @return void
     */
    public function refreshUnscheduledPresentations()
    {
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
        $this->authorize('edit-schedule');

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
            $this->refreshUnscheduledPresentations();
        }

        $this->dispatch("update-cell-r-{$presentation->room->id}-t-{$presentation->timeslot->id}");
        $this->dispatch("check-programme-status");
    }

    /**
     * Responsible for handling the removing of presentation
     * from the schedule
     *
     * @param $data
     * @return void
     */
    #[On('remove-presentation')]
    public function removeScheduledPresentation($data)
    {
        $presentation = Presentation::find($data['presentation_id']);
        $oldRoomId = $presentation->room_id;
        $oldTimeslotId = $presentation->timeslot_id;

        $presentation->update([
            'start' => null
        ]);
        $presentation->room()->dissociate();
        $presentation->timeslot()->dissociate();
        $presentation->save();
        $presentation->refresh();

        $this->refreshUnscheduledPresentations();

        $this->dispatch("update-cell-r-{$oldRoomId}-t-{$oldTimeslotId}");
        $this->dispatch("check-programme-status");
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.schedule.grid-parent-component');
    }
}

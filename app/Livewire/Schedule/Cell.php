<?php

namespace App\Livewire\Schedule;

use App\Actions\Schedule\PresentationAllocationHelper;
use App\Actions\Schedule\PresentationConflictChecker;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Cell extends Component
{
    public $id;
    public $timeslot;
    public $room;
    public $presentations;

    public function mount($timeslot, $room)
    {
        $this->timeslot = $timeslot;
        $this->room = $room;
        $this->id = "r-{$this->room->id}-t-{$this->timeslot->id}";

        $this->presentations = $this->room->presentations()
            ->where('start', '>=', Carbon::parse($this->timeslot->start))
            ->where('start', '<', Carbon::parse($this->timeslot->start)->copy()->addMinutes(30))
            ->orderBy('start', 'asc')
            ->get();
    }

    public function movePresentation($id, $newRoom, $newTimeslot)
    {
        $presentation = Presentation::find($id);
        $room = Room::find($newRoom);
        $timeslot = Timeslot::find($newTimeslot);

        if (is_null($presentation) || is_null($room) || is_null($timeslot)) {
            Toaster::error('An issue has occurred. Try again');
            return;
        }

        $passedChecks = false;

        $presentationChecker = new PresentationConflictChecker();
        if ($presentationChecker->isClearOfConflicts($presentation, $room, $timeslot->start)) {
            $this->dispatchMoveEventToGrid($presentation->id, $room->id, $timeslot->id, $timeslot->start);
            $passedChecks = true;
        } else {
            $passedChecks = $this->tryUsingPresentationAllocator($presentation, $timeslot, $room);
        }

        if (!$passedChecks) {
            Toaster::error('A scheduling conflict has occurred, the presentation cannot be moved to the
                desired position');
        }
    }

    public function tryUsingPresentationAllocator($presentation, $timeslot, $room)
    {
        $allocationHelper = new PresentationAllocationHelper();
        $canAllocatorHelp = $allocationHelper->canHelp($presentation, $timeslot, $room);

        if ($canAllocatorHelp == 1) {
            $possibleStartingTime = $allocationHelper
                ->tryToSchedulePresentationInTimeslot($presentation, $timeslot, $room);

            $this->dispatchMoveEventToGrid(
                $presentation->id,
                $room->id,
                $timeslot->id,
                $possibleStartingTime->format('H:i'));
        } elseif ($canAllocatorHelp == 2) {
            $possibleStartingTime = $allocationHelper
                ->tryToScheduleInPreviousTimeslot($presentation, $timeslot, $room);

            $newTimeslot = $allocationHelper->findTimeslotByStartingTime($possibleStartingTime);

            $this->dispatchMoveEventToGrid(
                $presentation->id,
                $room->id,
                $newTimeslot->id,
                $possibleStartingTime->format('H:i'));
        }

        return $canAllocatorHelp != 0;
    }

    public function dispatchMoveEventToGrid($id, $newRoom, $newTimeslot, $newTime)
    {
        $this->dispatch('move-presentation', data: [
            'presentation_id' => $id,
            'new_room_id' => $newRoom,
            'new_timeslot_id' => $newTimeslot,
            'new_time' => $newTime
        ]);
    }

    #[On("update-cell-{id}")]
    public function refresh()
    {
        $timeslotStart = Carbon::parse($this->timeslot->start);
        $this->presentations = $this->room->presentations()
            ->where('start', '>=', $timeslotStart)
            ->where('start', '<', $timeslotStart->copy()->addMinutes(30))
            ->orderBy('start', 'asc')
            ->get();

        foreach ($this->presentations as $presentation) {
            $this->dispatch('update-presentation-' . $presentation->id);
        }
    }

    public function render()
    {
        return view('livewire.schedule.cell');
    }
}

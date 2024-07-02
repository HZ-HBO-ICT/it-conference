<?php

namespace App\Livewire\Schedule;

use App\Actions\Schedule\PresentationAllocationHelper;
use App\Actions\Schedule\PresentationConflictChecker;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Cell extends Component
{
    public $id;
    public $timeslot;
    public $room;
    public $presentations;
    public $height;

    /**
     * Initializes the component
     * @param $timeslot
     * @param $room
     * @return void
     */
    public function mount($timeslot, $room)
    {
        $this->timeslot = $timeslot;
        $this->room = $room;
        $this->id = "r-{$this->room->id}-t-{$this->timeslot->id}";
        $this->height = $this->calculateHeightInREM();

        $this->presentations = $this->room->presentations()
            ->where('start', '>=', Carbon::parse($this->timeslot->start))
            ->where('start', '<', Carbon::parse($this->timeslot->start)
                ->copy()
                ->addMinutes($this->timeslot->duration))
            ->orderBy('start', 'asc')
            ->get();
    }

    /**
     * Handles the moving of a presentation by doing checks to see if the move is allowed
     * and then sends an event to the parent component
     * @param $id
     * @param $newRoom
     * @param $newTimeslot
     * @return void
     */
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

    /**
     * If the presentation is not directly cleared from the checks, an allocator can help
     * to schedule the presentation
     * @param $presentation
     * @param $timeslot
     * @param $room
     * @return bool
     */
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
                $possibleStartingTime->format('H:i')
            );
        } elseif ($canAllocatorHelp == 2) {
            $possibleStartingTime = $allocationHelper
                ->tryToScheduleInPreviousTimeslot($presentation, $timeslot, $room);

            $newTimeslot = $allocationHelper->findTimeslotByStartingTime($possibleStartingTime);

            $this->dispatchMoveEventToGrid(
                $presentation->id,
                $room->id,
                $newTimeslot->id,
                $possibleStartingTime->format('H:i')
            );
        }

        return $canAllocatorHelp != 0;
    }

    /**
     * Dispatches a moving event to the parent
     * @param $id
     * @param $newRoom
     * @param $newTimeslot
     * @param $newTime
     * @return void
     */
    public function dispatchMoveEventToGrid($id, $newRoom, $newTimeslot, $newTime)
    {
        $this->dispatch('move-presentation', data: [
            'presentation_id' => $id,
            'new_room_id' => $newRoom,
            'new_timeslot_id' => $newTimeslot,
            'new_time' => $newTime
        ]);
    }

    /**
     * Listens for the parent to dispatch an event to update the cell
     * and sends update event to the child components in this cell
     * @return void
     */
    #[On("update-cell-{id}")]
    public function refresh()
    {
        $timeslotStart = Carbon::parse($this->timeslot->start);
        $this->presentations = $this->room->presentations()
            ->where('start', '>=', $timeslotStart)
            ->where('start', '<', $timeslotStart->copy()->addMinutes($this->timeslot->duration))
            ->orderBy('start', 'asc')
            ->get();

        foreach ($this->presentations as $presentation) {
            $this->dispatch('update-presentation-' . $presentation->id);
        }
    }

    /**
     * Calculates the height of the element in REM based on it's timeslot duration
     * @return float
     */
    protected function calculateHeightInREM()
    {
        return $this->timeslot->duration * (14 / 30) * 0.25;
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.schedule.cell');
    }
}

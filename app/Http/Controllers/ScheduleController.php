<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScheduleController extends Controller
{
    public function overview(): View
    {
        $lectures = Presentation::with(['timeslot' => function ($query) {
            $query->orderBy('start');
        }])->where('type', 'lecture')
            ->get()
            ->filter(function ($presentation) {
            return $presentation->isApproved;
        });
        $lectureTimeslots = Timeslot::where('duration', 30)->get();

        $workshops = Presentation::with(['timeslot' => function ($query) {
            $query->orderBy('start');
        }])->where('type', 'workshop')
            ->get()
            ->filter(function ($presentation) {
                return $presentation->isApproved;
            });
        $workshopTimeslots = Timeslot::where('duration', 90)->get();

        $numberOfPresentationRequest = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isApproved;
        })->count();

        $numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();

        return view('moderator.schedule.schedule',
            compact('lectures',
                'lectureTimeslots',
                'workshops',
                'workshopTimeslots',
                'numberOfPresentationRequest',
                'numberOfUnscheduledPresentations'));
    }

    public function generateSchedule(): RedirectResponse
    {
        $this->schedulePresentations();

        return redirect(route('moderator.schedule.overview'));
    }

    public function scheduleDraft(): View
    {

    }

    private function schedulePresentations()
    {
        $presentations = Presentation::whereDoesntHave('room')
            ->whereDoesntHave('timeslot')
            ->get();

        foreach ($presentations as $presentation) {
            $timeslots = Timeslot::where('duration', $presentation->type == 'lecture' ? 30 : 90)
                ->get();
            $rooms = (new RoomController())->getRoomsWithClosestCapacity(12);

            $availableCombination = $rooms->crossJoin($timeslots)
                ->first(function ($room_timeslot) {
                    return $this->checkIfTimeslotAndRoomAreAvailable($room_timeslot[0], $room_timeslot[1]);
                });

            if ($availableCombination) {
                $presentation->room_id = $availableCombination[0]->id;
                $presentation->timeslot_id = $availableCombination[1]->id;
                $presentation->save();
            }
        }
    }

    /**
     * Checks that the combination of room and timeslot is not yet used, then checks if
     * the previous presentation in the room has ended before asserting if it's available
     *
     * @param $room
     * @param $timeslot
     * @return bool
     */
    private function checkIfTimeslotAndRoomAreAvailable($room, $timeslot): bool
    {
        // Checks the unique combination
        $isRoomAvailable = Presentation::whereHas('room', function ($query) use ($room) {
            $query->where('rooms.id', $room->id);
        })->whereHas('timeslot', function ($query) use ($timeslot) {
            $query->where('timeslots.id', $timeslot->id);
        })->doesntExist();

        // Checks if the presentations already assigned to this room have ended
        if ($isRoomAvailable) {
            foreach ($room->presentations as $presentation) {
                if (Carbon::parse($presentation->timeslot->start)
                        ->addMinutes($presentation->timeslot->duration) > Carbon::parse($timeslot->start))
                    return false;
            }
        }

        return $isRoomAvailable;
    }
}

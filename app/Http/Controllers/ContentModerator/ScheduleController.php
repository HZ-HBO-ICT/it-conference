<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\DefaultPresentation;
use App\Models\EventInstance;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Type\Time;

class ScheduleController extends Controller
{
    /**
     * Display the overview for scheduling
     *
     * @return View
     */
    public function overview(): View
    {
        $lectureTimeslots = Timeslot::where('duration', 30)->orderBy('start')->get();
        $workshopTimeslots = Timeslot::where('duration', 90)->orderBy('start')->get();

        $numberOfPresentationRequest = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isApproved;
        })->count();

        $numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();

        $numberOfAvailableRooms = Room::all()->count();

        return view('moderator.schedule.index',
            compact(
                'lectureTimeslots',
                'workshopTimeslots',
                'numberOfPresentationRequest',
                'numberOfUnscheduledPresentations',
                'numberOfAvailableRooms'));
    }

    /**
     * Automatically generates a schedule
     *
     * @return RedirectResponse
     */
    public function generate(): RedirectResponse
    {
        // If there are no timeslots generated yet, generate timeslots first
        if (Timeslot::all()->count() == 0) {
            return redirect(route('moderator.schedule.timeslots.create'));
        }

        $presentationsScheduled = $this->schedulePresentations();
        $unscheduled = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();

        $message = '';

        if ($presentationsScheduled > 0) {
            $message = 'The autofill scheduled successfully ' . $presentationsScheduled . ' presentations.';

            if ($unscheduled > 0) {
                $message = $message . 'There are ' . $unscheduled . ' more presentations not scheduled due to lack of rooms or timeslots. Add new rooms or assign manually the presentations.';
            }
        } else {
            if ($unscheduled) {
                $message = 'There are ' . $unscheduled . ' presentations not scheduled due to lack of rooms or timeslots. Add new rooms or schedule manually the presentations.';
            } else {
                $message = 'There are no presentations to be scheduled';
            }
        }

        return redirect(route('moderator.schedule.overview'))->banner($message);
    }

    /**
     * Displays list of all presentations that need to be scheduled
     *
     * @return View
     */
    public function presentationsForScheduling(): View
    {
        $presentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        });

        return view('moderator.schedule.presentations.index', compact('presentations'));
    }

    /**
     * Displays a view in which you can schedule manually a presentation
     *
     * @param Presentation $presentation
     * @return View
     */
    public function schedulePresentation(Presentation $presentation): View
    {
        return view('moderator.schedule.presentations.show', compact('presentation'));
    }

    /**
     * Stores the scheduling details of the given presentation
     *
     * @param Request $request
     * @param Presentation $presentation
     * @return mixed
     */
    public function storeSchedulePresentation(Request $request, Presentation $presentation)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'timeslot_id' => 'required|exists:timeslots,id',
        ]);

        $presentation->room_id = $data['room_id'];
        $presentation->timeslot_id = $data['timeslot_id'];
        $presentation->save();

        return redirect(route('moderator.schedule.overview'))->banner('The presentation was successfully scheduled!');
    }

    /**
     * Automatically schedules presentations that are not scheduled yet - if it can find a
     * slot and a room available for them.
     *
     * @return int The number of successfully scheduled presentations
     */
    private function schedulePresentations(): int
    {
        $presentationsScheduled = 0;

        $presentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        });

        foreach ($presentations as $presentation) {
            $timeslots = Timeslot::where(function ($query) use ($presentation) {
                $query->where('id', '!=', DefaultPresentation::opening()->timeslot_id)
                    ->where('id', '!=', DefaultPresentation::closing()->timeslot_id)
                    ->where('duration', $presentation->type == 'lecture' ? 30 : 90);
            })->get();
            $rooms = Room::getWithClosestCapacity($presentation->max_participants);

            $availableCombination = $rooms->crossJoin($timeslots)
                ->first(function ($room_timeslot) {
                    return $this->checkIfTimeslotAndRoomAreAvailable($room_timeslot[0], $room_timeslot[1]);
                });

            if ($availableCombination) {
                $presentation->room_id = $availableCombination[0]->id;
                $presentation->timeslot_id = $availableCombination[1]->id;
                $presentation->save();

                $presentationsScheduled += 1;
            }
        }

        return $presentationsScheduled;
    }

    /**
     * Checks that the combination of room and timeslot is not yet used, then checks if
     * the previous presentation in the room has ended before asserting if it's available
     *
     * @param $room
     * @param $timeslot
     * @return bool
     */
    public function checkIfTimeslotAndRoomAreAvailable($room, $timeslot): bool
    {
        // Checks the unique combination
        $isRoomAvailable = Presentation::whereHas('room', function ($query) use ($room) {
            $query->where('rooms.id', $room->id);
        })->whereHas('timeslot', function ($query) use ($timeslot) {
            $query->where('timeslots.id', $timeslot->id);
        })->doesntExist();

        // Checks if the timeslot is not overlapping the timeslots of the
        // presentations already assigned to this room
        if ($isRoomAvailable) {
            foreach ($room->presentations as $presentation) {
                $presentationStart = Carbon::parse($presentation->timeslot->start);
                $presentationEnd = Carbon::parse($presentation->timeslot->start)
                    ->copy()
                    ->addMinutes($presentation->timeslot->duration);

                $timeslotStart = Carbon::parse($timeslot->start);
                $timeslotEnd = Carbon::parse($timeslot->start)
                    ->addMinutes($timeslot->duration);

                if ($presentationEnd <= $timeslotStart) {
                    continue;
                }

                if ($presentationStart >= $timeslotEnd) {
                    continue;
                }

                return false;
            }

            if ($room->presentations->count() == 0) {
                return true;
            }
        }

        return $isRoomAvailable;
    }
}

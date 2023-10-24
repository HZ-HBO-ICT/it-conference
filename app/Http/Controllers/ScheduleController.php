<?php

namespace App\Http\Controllers;

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
    public function index(): View
    {
        if (!EventInstance::current()->is_final_programme_released)
            abort(404);

        $lectureTimeslots = Timeslot::where('duration', 30)->get();
        $workshopTimeslots = Timeslot::where('duration', 90)->get();

        return view('presentations.index',
            compact('lectureTimeslots', 'workshopTimeslots'));
    }

    /**
     * Display the overview for scheduling
     *
     * @return View
     */
    public function overview(): View
    {
        $lectureTimeslots = Timeslot::where('duration', 30)->get();
        $workshopTimeslots = Timeslot::where('duration', 90)->get();

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

        return view('moderator.schedule.presentations-for-scheduling', compact('presentations'));
    }

    /**
     * Displays a view in which you can schedule manually a presentation
     *
     * @param Presentation $presentation
     * @return View
     */
    public function schedulePresentation(Presentation $presentation): View
    {
        return view('moderator.schedule.presentation-schedule', compact('presentation'));
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
            $timeslots = Timeslot::where('duration', $presentation->type == 'lecture' ? 30 : 90)
                ->get();
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

    /**
     * Renders the view for creating opening/closing
     * @param string $event
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function createDefaultPresentation(string $event)
    {
        return view('moderator.schedule.default-presentations.create', compact('event'));
    }

    /**
     * Handles the creation of the opening presentation for the event
     * @param Request $request
     * @return void
     */
    public function storeOpeningPresentation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'room_id' => 'required|numeric'
        ]);

        $timeslotValidated = $request->validate([
            'starting' => 'required|date_format:H:i',
            'ending' => 'required|date_format:H:i|after:starting'
        ]);

        $starting = Carbon::parse($timeslotValidated['starting']);
        $ending = Carbon::parse($timeslotValidated['ending']);

        $duration = $ending->diffInMinutes($starting);

        $timeslot = Timeslot::create([
            'start' => $starting,
            'duration' => $duration
        ]);

        $validated['type'] = 'opening';
        $validated['timeslot_id'] = $timeslot->id;
        DefaultPresentation::create($validated);

        return redirect(route("moderator.schedule.default.presentation.create", "closing"))->banner('The opening is created successfully');
    }

    /**
     * Handles the creation of the closing presentation for the event
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeClosingPresentation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'room_id' => 'required|numeric'
        ]);

        $timeslotValidated = $request->validate([
            'starting' => 'required|date_format:H:i',
            'ending' => 'required|date_format:H:i|after:starting'
        ]);

        $starting = Carbon::parse($timeslotValidated['starting']);
        $ending = Carbon::parse($timeslotValidated['ending']);

        $openingTimeslot = DefaultPresentation::opening()->timeslot;
        $openingTimeslotEnd = Carbon::parse($openingTimeslot->start)
            ->addMinutes($openingTimeslot->duration);
        $closingTimeslotStart = $starting;

        if ($openingTimeslotEnd > $closingTimeslotStart) {
            return redirect()->back()->withErrors(['starting' => 'The closing time cannot be before the opening one']);
        }

        $duration = $ending->diffInMinutes($starting);

        $timeslot = Timeslot::create([
            'start' => $starting,
            'duration' => $duration
        ]);

        $validated['type'] = 'closing';
        $validated['timeslot_id'] = $timeslot->id;
        DefaultPresentation::create($validated);

        TimeslotController::generate($openingTimeslotEnd->toTimeString(),
            $closingTimeslotStart->toTimeString());

        return redirect(route('moderator.schedule.overview'));
    }
}

<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TimeslotController;
use App\Models\DefaultPresentation;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DefaultPresentationController extends Controller
{
    /**
     * Renders the view for creating opening/closing
     * @param string $event
     * @return View
     */
    public function create(string $event): View
    {
        // If the opening and closing don't exist already and the correct event is passed
        if ((is_null(DefaultPresentation::opening()) && $event == 'opening')
            || (is_null(DefaultPresentation::closing()) && $event == 'closing')) {
            return view('moderator.schedule.default-presentations.create', compact('event'));
        }

        abort(404);
    }

    /**
     * Handles the creation of the opening presentation for the event
     * @param Request $request
     * @return mixed
     */
    public function storeOpening(Request $request)
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
     */
    public function storeClosing(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'room_id' => 'required|numeric',
            'duration' => 'required|numeric|min:0'
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
            $closingTimeslotStart->toTimeString(),
            $validated['duration']);

        return redirect(route('moderator.schedule.overview'));
    }

    /**
     * Renders the view for editing opening/closing
     * @param string $event
     * @return View
     */
    public function edit(string $event): View
    {
        return view('moderator.schedule.default-presentations.edit', compact('event'));
    }
}

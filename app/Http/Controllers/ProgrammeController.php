<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    /**
     * Displays an index page of the general programme
     *
     * @return View
     */
    public function index(): View
    {
        $lectures = Presentation::where('type', 'lecture')
            ->whereNotNull('room_id')
            ->whereNotNull('timeslot_id')
            ->orderBy('start')
            ->get();

        $workshops = Presentation::where('type', 'workshop')
            ->whereNotNull('room_id')
            ->whereNotNull('timeslot_id')
            ->orderBy('start')
            ->get();

        $lectureTimeslots = $lectures->map->only('start')->unique();
        $workshopTimeslots = $workshops->map->only('start')->unique();

        return view('programme.index', compact(
            'lectures',
            'workshops',
            'lectureTimeslots',
            'workshopTimeslots'
        ));
    }

    /**
     * Displays details of the specific presentation
     *
     * @param Presentation $presentation
     * @return View
     */
    public function show(Presentation $presentation): View
    {
        return view('programme.show', compact('presentation'));
    }

    /**
     * Handles enrollment for the presentation
     *
     * @param Presentation $presentation
     * @return int
     */
    public function enroll(Presentation $presentation)
    {
        if (Auth::user()->cannot('enroll', $presentation)) {
            return 403;
        }

        $enrollmentResult = Auth::user()->joinPresentation($presentation);

        if (!$enrollmentResult) {
            return redirect(route('programme.presentation.show', compact('presentation')))
                ->banner("Something went wrong with enrolling for {$presentation->name}");
        }

        return redirect(route('programme'))
            ->banner("You have successfully enrolled for {$presentation->name}");
    }

    /**
     * Handles disenrollment from the presentation
     *
     * @param Presentation $presentation
     * @return int
     */
    public function disenroll(Presentation $presentation)
    {
        if (Auth::user()->cannot('disenroll', $presentation)) {
            return 403;
        }

        Auth::user()->leavePresentation($presentation);

        return redirect(route('programme'))
            ->banner("You have successfully deregistered from the {$presentation->name}");
    }
}

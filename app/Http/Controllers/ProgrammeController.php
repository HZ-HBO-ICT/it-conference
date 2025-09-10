<?php

namespace App\Http\Controllers;

use App\Models\DefaultPresentation;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        if (!optional(Edition::current())->is_final_programme_released) {
            abort(404);
        }

        $presentations = Presentation::all()
            ->where(function ($presentation) {
                return $presentation->isScheduled;
            });

        $opening = DefaultPresentation::opening();
        $closing = DefaultPresentation::closing();

        $presentations = $presentations->sortBy('start');

        $rooms = Room::whereHas('presentations')->get();

        $openingHeight = Carbon::parse($opening->start ?? 'default start')->diffInMinutes($opening->end ?? 'default end') * (14/30) * 0.25;
        $closingHeight = Carbon::parse($closing->start ?? 'default start')->diffInMinutes($closing->end  ?? 'default end') * (14/30) * 0.25;

        $height = 30 * (14 / 30) * 0.25;

        $timeslots = Timeslot::all();

        return view('programme.index', compact(
            'presentations',
            'rooms',
            'timeslots',
            'height',
            'opening',
            'closing',
            'openingHeight',
            'closingHeight',
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
        if (!$presentation->is_approved) {
            abort(404);
        }

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

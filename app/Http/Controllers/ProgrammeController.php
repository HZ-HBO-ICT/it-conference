<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProgrammeController extends Controller
{
    public function index(): View
    {
        $lectures = Presentation::where('type', 'lecture')->orderBy('start')->get();
        $workshops = Presentation::where('type', 'workshop')->orderBy('start')->get();
        $lectureTimeslots = $lectures->map->only('start');
        $workshopTimeslots = $workshops->map->only('start');

        return view('programme.index', compact(
            'lectures',
            'workshops',
            'lectureTimeslots',
            'workshopTimeslots'
        ));
    }

    public function show(Presentation $presentation): View
    {
        return view('programme.show', compact('presentation'));
    }

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

        return redirect(route('programme.presentation.show', compact('presentation')))
            ->banner("You have successfully enrolled for {$presentation->name}");
    }

    public function disenroll(Presentation $presentation)
    {
        if (Auth::user()->cannot('disenroll', $presentation)) {
            return 403;
        }

        Auth::user()->leavePresentation($presentation);

        return redirect(route('programme.presentation.show', compact('presentation')))
            ->banner("You have successfully deregistered from the {$presentation->name}");
    }
}

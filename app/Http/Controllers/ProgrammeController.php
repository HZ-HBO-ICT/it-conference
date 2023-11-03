<?php

namespace App\Http\Controllers;

use App\Models\EventInstance;
use App\Models\Presentation;
use App\Models\Timeslot;
use Illuminate\Contracts\View\View;

class ProgrammeController extends Controller
{
    /**
     * Returns the general programme view
     * @return View
     */
    public function index(): View
    {
        if (!EventInstance::current()->is_final_programme_released)
            abort(404);

        $lectureTimeslots = Timeslot::where('duration', 30)->get();
        $workshopTimeslots = Timeslot::where('duration', 80)->get();

        return view('programme.index',
            compact('lectureTimeslots', 'workshopTimeslots'));
    }

    /**
     * Returns the presentation details public facing page
     * @param Presentation $presentation
     * @return View
     */
    public function show(Presentation $presentation): View
    {
        if (!EventInstance::current()->is_final_programme_released)
            abort(404);

        return view('programme.show', compact('presentation'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
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
}

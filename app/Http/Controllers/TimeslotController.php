<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class TimeslotController extends Controller
{
    /**
     * Displays the view for generating timeslots
     *
     * @return View
     */
    public function create(): View
    {
        return view('moderator.schedule.timeslots.create');
    }

    /**
     * Generates all timeslots based on the data passed by the request
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'starting' => 'required|date_format:H:i',
            'ending' => 'required|date_format:H:i|after:starting',
        ];

        $validatedData = $request->validate($rules);

        $starting = $validatedData['starting'];
        $ending = $validatedData['ending'];

        $this->generate($starting, $ending);

        if (Room::all()->count() == 0) {
            return redirect(route('rooms.index'));
        }

        return redirect(route('moderator.schedule.overview'));
    }

    /**
     * Generates timeslots for lectures and workshop
     * from the starting time till the ending time
     *
     * @param $starting
     * @param $ending
     * @param $padding int free time between timeslots
     */
    public static function generate($starting, $ending, $padding)
    {
        $current = Carbon::parse($starting)->addMinutes($padding);
        $finalPossibleStartingTime = Carbon::parse($ending)->subMinutes(90 + $padding);
        while ($current <= $finalPossibleStartingTime) {
            Timeslot::create([
                'start' => $current,
                'duration' => 90
            ]);
            $current->addMinutes(90 + $padding);
        }

        $current = Carbon::parse($starting)->addMinutes($padding);
        $finalPossibleStartingTime = Carbon::parse($ending)->subMinutes(30 + $padding);
        while ($current <= $finalPossibleStartingTime) {
            Timeslot::create([
                'start' => $current,
                'duration' => 30
            ]);
            $current->addMinutes(30 + $padding);
        }
    }
}

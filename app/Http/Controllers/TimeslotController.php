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
        return view('moderator.schedule.timeslots-create');
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
     * @return void
     */
    private function generate($starting, $ending)
    {
        $current = Carbon::parse($starting);
        $finalPossibleStartingTime = Carbon::parse($ending)->subMinutes(90);
        while ($current <= $finalPossibleStartingTime) {
            Timeslot::create([
                'start' => $current,
                'duration' => 90
            ]);
            $current->addMinutes(100);
        }

        $current = Carbon::parse($starting);
        $finalPossibleStartingTime = Carbon::parse($ending)->subMinutes(30);
        while ($current <= $finalPossibleStartingTime) {
            Timeslot::create([
                'start' => $current,
                'duration' => 30
            ]);
            $current->addMinutes(40);
        }
    }
}

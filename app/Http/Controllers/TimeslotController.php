<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

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

        TimeslotController::generate($starting, $ending, 10);

        if (Room::all()->count() == 0) {
            return redirect(route('rooms.index'));
        }

        return redirect(route('moderator.schedule.overview'));
    }

    /**
     * Generates timeslots for lectures and workshops
     * from the starting time till the ending time
     *
     * @param $starting
     * @param $ending
     * @param $padding
     */
    public static function generate($starting, $ending, $padding)
    {
        self::generateTimeslots($starting, $ending, $padding, 90, 80);
        self::generateTimeslots($starting, $ending, $padding, 30, 30);
    }

    /**
     * Generates timeslots for a given duration and interval
     *
     * @param string $starting The start time
     * @param string $ending The end time
     * @param int $padding The padding time between timeslots
     * @param int $duration The duration of the timeslot
     * @param int $interval The interval between the start of each timeslot
     */
    private static function generateTimeslots(string $starting, string $ending, int $padding, int $duration, int $interval)
    {
        $current = Carbon::parse($starting)->addMinutes($padding);
        $finalPossibleStartingTime = Carbon::parse($ending)->subMinutes($duration + $padding);

        while ($current <= $finalPossibleStartingTime) {
            Timeslot::create([
                'start' => $current,
                'duration' => $duration
            ]);
            $current->addMinutes($interval + $padding);
        }
    }
}

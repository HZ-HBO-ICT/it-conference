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

        if ($request->all()['breakStart'])
            $rules['breakStart'] = 'date_format:H:i|after:starting|before:ending';

        if ($request->all()['breakEnd'])
            $rules['breakEnd'] = 'date_format:H:i|after:breakStart|before:ending';

        $validatedData = $request->validate($rules);

        $starting = $validatedData['starting'];
        $ending = $validatedData['ending'];
        $breakStart = key_exists('breakStart', $validatedData) ? $validatedData['breakStart'] : '12:30';
        $breakEnd = key_exists('breakEnd', $validatedData) ? $validatedData['breakEnd'] : '13:00';

        if($breakEnd < $breakStart)
        {
            return redirect(route('moderator.schedule.timeslots.create'))
                ->withInput()
                ->withErrors(['breakEnd' => 'The ending time of the break cannot be before the starting time']);
        }

        $this->generate($starting, $breakStart);
        $this->generate($breakEnd, $ending);

        if (Room::all()->count() == 0) {
            return redirect(route('rooms.index'));
        }

        return redirect(route('moderator.schedule.draft'));
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

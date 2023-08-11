<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimeslotController extends Controller
{
    public function create()
    {
        return view('moderator.schedule.timeslots-create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'starting' => 'required|date_format:H:i',
            'ending' => 'required|date_format:H:i|after:starting',
            'breakStart' => 'date_format:H:i|after:starting|before:ending',
            'breakEnd' => 'date_format:H:i|after:breakStart|before:ending'
        ]);

        $starting = $validatedData['starting'];
        $ending = $validatedData['ending'];
        $breakStart = $validatedData['breakStart'];
        $breakEnd = $validatedData['breakEnd'];

        $this->generate($starting, is_null($breakStart) ? '12:30' : $breakStart);
        $this->generate(is_null($breakEnd) ? '13:00' : $breakEnd, $ending);

        if(Room::all()->count() == 0)
        {
            return redirect(route('rooms.index'));
        }

        return redirect(route('moderator.schedule.draft'));
    }

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

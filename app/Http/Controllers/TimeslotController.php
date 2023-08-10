<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimeslotController extends Controller
{
    public function generateTimeslots($starting, $ending)
    {
        $current = Carbon::parse($starting);
        $finalPossibleStartingTime = Carbon::parse($ending)->subMinutes(30);
        Timeslot::create([
            'start' => $current,
            'duration' => 90
        ]);

        while($current <= $finalPossibleStartingTime)
        {
            Timeslot::create([
                'start' => $current,
                'duration' => 30
            ]);
            $current->addMinutes(40);
        }
    }
}

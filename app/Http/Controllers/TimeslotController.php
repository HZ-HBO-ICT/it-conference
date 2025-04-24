<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    public static function generate()
    {
        // Implementation of timeslot generation
        return Timeslot::all();
    }
} 
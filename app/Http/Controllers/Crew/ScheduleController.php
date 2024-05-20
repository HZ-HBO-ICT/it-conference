<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * Returns the page with general management overview of the schedule
     * @return View
     */
    public function index() : View
    {
        return view('crew.schedule.index');
    }
}

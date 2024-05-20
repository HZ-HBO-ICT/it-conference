<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function overview(){
        return view('crew.schedule.index');
    }
}

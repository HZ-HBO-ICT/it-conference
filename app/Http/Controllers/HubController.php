<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Timeslot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HubController extends Controller
{
    /**
     * get view for announcements
     */
    public function getConferenceHome()
    {
        return view('myhub.home');
    }

    /**
     * get view for profile information
     */
    public function getProfileInfo()
    {
        return view('myhub.profile');
    }

    /**
     * get personal programme for the user
     */
    public function programme()
    {
        $presentations = Auth::user()->presentations;

        $lectureTimeslots = Timeslot::where('duration', 30)->get();
        $workshopTimeslots = Timeslot::where('duration', 80)->get();

        if (Auth::user()->speaker) {
            $presentations->push(Auth::user()->speaker->presentation);
        }
        $presentations = $presentations->sortBy('timeslot.start');

        return view('myhub.programme', compact('presentations','lectureTimeslots', 'workshopTimeslots'));
    }
}

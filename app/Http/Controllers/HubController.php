<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HubController extends Controller
{
    /**
     * get view for announcements
     */
    public function getAnnouncements() {
        return view('myhub.announcement');
    }

    /**
     * get view for profile information
     */
    public function getProfileInfo() {
        return view('myhub.profile');
    }

    /**
     * get personal programme for the user
     */
    public function getProgramme() {
        $user = User::where('name', Auth::user()->name)->first();
        $presentations = $user->presentations->sortBy('timeslot.start');

        return view('myhub.programme', compact('presentations'));
    }

    /**
     * detach participation in specified presentation for a user
     * @param $presentationId id for presentation to detach from participants table
     */
    public function detachParticipation($presentationId) {
        $user = User::where('name', Auth::user()->name)->first();

        //delete the record from participants table
        $user->presentations()->detach($presentationId);

        return redirect(route('my-programme'));
    }
}
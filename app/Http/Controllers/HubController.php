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
    public function getConferenceHome()
    {
        return view('myhub.home');
    }

    /**
     * get view for profile information
     */
    public function getProfileInfo()
    {
        if (Auth::user()->hasRole('content moderator')) {
            return view('moderator.profile');
        }

        return view('myhub.profile');
    }

    /**
     * get personal programme for the user
     */
    public function getProgramme()
    {
        if (Auth::user()->hasRole('content moderator')) {
            abort(404);
        }

        $user = Auth::user();
        $presentations = $user->presentations->sortBy('timeslot.start');

        return view('myhub.programme', compact('presentations'));
    }

    /**
     * detach participation in specified presentation for a user
     * @param $presentationId id for presentation to detach from participants table
     */
    public function detachParticipation($presentationId)
    {
        if (Auth::user()->hasRole('content moderator')) {
            abort(404);
        }

        $user = Auth::user();

        //delete the record from participants table
        $user->presentations()->detach($presentationId);

        return redirect(route('my-programme'));
    }
}

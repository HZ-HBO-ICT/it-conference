<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
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

        if (Auth::user()->speaker) {
            $presentations->push(Auth::user()->speaker->presentation);
        }
        $presentations = $presentations->sortBy('timeslot.start');

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

    public function enroll(Presentation $presentation)
    {
        Auth::user()->can('enroll', $presentation);
        Auth::user()->presentations()->attach($presentation);

        return redirect()->back()->banner('You successfully enrolled in this presentation');
    }

    public function disenroll(Presentation $presentation)
    {
        if (!Auth::user()->presentations->contains($presentation)) {
            return redirect()->back()->banner('You are not enrolled in this presentation');
        }

        Auth::user()->presentations()->detach($presentation);

        return redirect()->back()->banner('You successfully disenrolled of this presentation');
    }
}

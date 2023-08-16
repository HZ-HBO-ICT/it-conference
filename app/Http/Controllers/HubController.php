<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
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
        $presentations = Auth::user()->presentations->sortBy('timeslot.start');

        return view('myhub.programme', compact('presentations'));
    }

    /**
     * get all the available presentations for user to register for
     */
    public function registerForPresentations() {
        //get all presentations ordered by their start time
        $presentations = Presentation::join('timeslots', 'timeslots.id', '=', 'presentations.timeslot_id')->orderBy('timeslots.start')->get();

        //get ids of presentations that the user is enrolled for, if any
        $enrolledPresentations = Auth::user()->presentations->pluck('id')->toArray();

        return view('myhub.programme-register', compact(['presentations', 'enrolledPresentations']));
    }

    /**
     * detach participation in specified presentation for a user
     * @param $presentationId id for presentation to detach from participants table
     */
    public function detachParticipation($presentationId) {
        //delete the record from participants table
        Auth::user()->presentations()->detach($presentationId);

        return redirect(route('my-programme-register'));
    }

    /**
     * attach participation in specified presentation for a user
     * @param $presentationId id for presentation to attach to participants table
     */
    public function attachParticipation($presentationId) {
        $presentation = Presentation::find($presentationId);

        //add the participant to the presentation if it is not full
        if ($presentation->participants->count() < $presentation->max_participants) Auth::user()->presentations()->attach($presentationId);

        return redirect(route('my-programme-register'));
    }
}

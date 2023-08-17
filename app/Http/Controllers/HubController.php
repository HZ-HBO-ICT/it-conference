<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $disabledPresentations = [];

        //loop through all presentations
        for ($i = 0; $i < $presentations->count(); $i ++) {
            //if user is already registered for a current presentation
            if (in_array($presentations[$i]->id, $enrolledPresentations)) {

                //remember the start time of the enrolled presentation
                [$lastEnrolledPresentationStartHours, $lastEnrolledPresentationStartMinutes] = explode(':', Carbon::parse($presentations[$i]->timeslot->start)->format('H:i'));

                //remember the type of the enrolled presentation
                $lastEnrolledPresentationType = $presentations[$i]->type;

                //loop through previous presentations
                for ($j = 0; $j < $i; $j ++) {

                    //remember the start time of the presentation on current iteration
                    [$currentHours, $currentMinutes] = explode(':', Carbon::parse($presentations[$j]->timeslot->start)->format('H:i'));

                    //check if the difference between start times of last enrolled presentation and presentation
                    //on current iteration is less than 60 minutes (if current presentation is of type 'presentation') or less than 90 minutes (if current presentation is of type 'workshop')
                    if (((int)$lastEnrolledPresentationStartHours * 60 + (int)$lastEnrolledPresentationStartMinutes) - ((int)$currentHours * 60 + (int)$currentMinutes) < 60 && $presentations[$j]->type == 'presentation'
                    || ((int)$lastEnrolledPresentationStartHours * 60 + (int)$lastEnrolledPresentationStartMinutes) - ((int)$currentHours * 60 + (int)$currentMinutes) < 90 && $presentations[$j]->type == 'workshop') {
                        $disabledPresentations[] = $presentations[$j]->id;
                    }
                }
            }
            //if user is not registered for current presentation and the last enrolled presentation exists
            else if (isset($lastEnrolledPresentationStartHours)) {

                //remember the start time of current presentation
                [$currentHours, $currentMinutes] = explode(':', Carbon::parse($presentations[$i]->timeslot->start)->format('H:i'));

                //perform the same check, but the other way around
                if (((int)$currentHours * 60 + (int)$currentMinutes) - ((int)$lastEnrolledPresentationStartHours * 60 + (int)$lastEnrolledPresentationStartMinutes) < 60 && $lastEnrolledPresentationType == 'presentation'
                    || ((int)$currentHours * 60 + (int)$currentMinutes) - ((int)$lastEnrolledPresentationStartHours * 60 + (int)$lastEnrolledPresentationStartMinutes) < 90 && $lastEnrolledPresentationType == 'workshop') {
                    $disabledPresentations[] = $presentations[$i]->id;
                }
            }
        }

        return view('myhub.programme-register', compact(['presentations', 'enrolledPresentations', 'disabledPresentations']));
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

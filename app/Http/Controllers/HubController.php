<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HubController extends Controller
{
    /**
     * get view for announcements
     */
    public function getAnnouncements()
    {
        return view('myhub.announcement');
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
    public function personalProgramme()
    {
        $presentations = Auth::user()->presentations->sortBy('timeslot.start');

        return view('myhub.programme', compact('presentations'));
    }

    /**
     * get all the available presentations for user to register for
     */
    public function presentations()
    {
        $lectureTimeslots = Timeslot::where('duration', 30)->get();
        $workshopTimeslots = Timeslot::where('duration', 90)->get();

        return view('myhub.programme-register', compact(['lectureTimeslots', 'workshopTimeslots']));
    }

    public function enroll(Presentation $presentation)
    {
        if ($presentation->maxParticipants() <= $presentation->participants->count()) {
            return redirect()->back()->banner('The presentation has reached the maximum participants');
        }
        if (Auth::user()->presentations->contains($presentation)) {
            return redirect()->back()->banner('You are already enrolled in this presentation');
        }

        $presentationStart = Carbon::parse($presentation->timeslot->start);
        $presentationEnd = Carbon::parse($presentation->timeslot->start)
            ->copy()
            ->addMinutes($presentation->timeslot->duration);

        foreach (Auth::user()->presentations as $enrolledPresentation) {
            $enrolledStart = Carbon::parse($enrolledPresentation->timeslot->start);
            $enrolledEnd = Carbon::parse($enrolledPresentation->timeslot->start)
                ->addMinutes($enrolledPresentation->timeslot->duration);

            if ($presentationEnd <= $enrolledStart) {
                continue;
            }

            if ($presentationStart >= $enrolledEnd) {
                continue;
            }

            return redirect()->back()
                ->banner('You have enrolled already in a presentation that takes place at the same time as this one');
        }

        DB::transaction(function () use ($presentation) {
            Auth::user()->presentations()->attach($presentation);
        });

        return redirect()->back()->banner('You successfully enrolled in this presentation');
    }

    public function disenroll(Presentation $presentation)
    {
        if (!Auth::user()->presentations->contains($presentation)) {
            return redirect()->back()->banner('You are not enrolled in this presentation');
        }

        DB::transaction(function () use ($presentation) {
            Auth::user()->presentations()->detach($presentation);
        });

        return redirect()->back()->banner('You successfully disenrolled in this presentation');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speakers = Speaker::where('is_approved', 1)
            ->where('is_main_speaker', 1)
            ->get();

        return view('speakers.index', compact('speakers'));
    }

    public function requestPresentation()
    {
        $canRequestPresentation = Auth::user()->currentTeam->isGoldenSponsor
            ? Auth::user()->can('sendRequestGoldenSponsor', Presentation::class)
            : Auth::user()->can('sendRequest', Presentation::class);

        if (!$canRequestPresentation) {
            abort(403);
        }

        return view('speakers.presentation-request');
    }

    public function processRequest(Request $request)
    {
        if (Auth::user()->currentTeam) {
            if (Auth::user()->currentTeam->owner->id === Auth::user()->id) {
                Auth::user()->currentTeam->users()->attach(
                    Auth::user(), ['role' => 'speaker']
                );
            }
        }

        $presentation =
            Presentation::create($request->validate(Presentation::rules()));

        if (Auth::user()->currentTeam && Auth::user()->currentTeam->sponsorTier && Auth::user()->currentTeam->sponsorTier->name !== 'golden') {
            foreach (Auth::user()->currentTeam->allSpeakers as $speaker) {
                Speaker::create([
                    'user_id' => $speaker->id,
                    'presentation_id' => $presentation->id,
                    'is_main_speaker' => Auth::user()->id == $speaker->id ? 1 : 0,
                    'is_approved' => 0,
                ]);
            }
        } else {
            Speaker::create([
                'user_id' => Auth::user()->id,
                'presentation_id' => $presentation->id,
                'is_main_speaker' => 1,
                'is_approved' => 0,
            ]);
        }

        return redirect(route('welcome'))->banner("You successfully send your request to host a {$presentation->type}");
    }

    // TODO: Refactor with gate
    /**
     * Allows the auth user to cohost a presentation if they are not already
     * hosting/cohosting a presentation; accessible only to the gold sponsor
     * @param Presentation $presentation
     * @return mixed
     */
    public function cohostPresentation(Presentation $presentation)
    {
        if (Auth::user()->currentTeam->sponsorTier && Auth::user()->currentTeam->sponsorTier->name !== 'golden') {
            abort(403);
        }
        if (Auth::user()->speaker) {
            abort(403);
        }

        Speaker::create([
            'user_id' => Auth::user()->id,
            'presentation_id' => $presentation->id,
            'is_main_speaker' => 0,
            'is_approved' => $presentation->mainSpeaker()->is_approved,
        ]);

        return redirect(route('announcements'))->banner("You successfully became a cohost to {$presentation->name}");
    }
}

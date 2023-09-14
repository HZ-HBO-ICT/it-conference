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

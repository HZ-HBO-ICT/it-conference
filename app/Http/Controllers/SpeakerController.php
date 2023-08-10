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
        $speakers = Speaker::where('is_approved', 1)->get();

        return view('speakers.index', compact('speakers'));
    }

    public function requestPresentation()
    {
        if (Auth::user()->cannot('sendRequest', Presentation::class)) {
            abort(403);
        }

        return view('speakers.presentation-request');
    }

    public function processRequest(Request $request)
    {
        $presentation =
            Presentation::create($request->validate(Presentation::rules()));

        Speaker::create([
            'user_id' => Auth::user()->id,
            'presentation_id' => $presentation->id,
            'is_main_speaker' => 1,
            'is_approved' => 0
        ]);

        return redirect(route('welcome'))->banner("You successfully send your request to host a {$presentation->type}");
    }
}

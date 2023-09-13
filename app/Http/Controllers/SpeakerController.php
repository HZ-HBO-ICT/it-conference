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
}

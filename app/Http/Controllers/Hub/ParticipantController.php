<?php

namespace App\Http\Controllers\Hub;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    public function programme()
    {
        $presentations = Auth::user()->participating_in;

        return view('myhub.programme', compact('presentations'));
    }
}

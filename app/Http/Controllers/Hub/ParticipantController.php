<?php

namespace App\Http\Controllers\Hub;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    /**
     * Displays the view of the personal programme for the participant
     *
     * @return View
     */
    public function programme(): View
    {
        $presentations = Auth::user()->participating_in;

        return view('myhub.programme', compact('presentations'));
    }
}

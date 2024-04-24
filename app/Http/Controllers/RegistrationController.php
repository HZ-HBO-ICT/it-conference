<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /**
     * Returns the registration page for participants
     * @return View
     */
    public function showParticipantRegistration() : View
    {
        return view('auth.registration.participant');
    }
}

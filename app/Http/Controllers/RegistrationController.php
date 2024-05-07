<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\RegisterResponse;

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

    /**
     * Returns the registration page for company representatives
     * @return View
     */
    public function showCompanyRegistration() : View
    {
        return view('auth.registration.company');
    }
}

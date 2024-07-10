<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\RegisterResponse;

class RegistrationController extends Controller
{
    /**
     * Returns the registration page for participants
     */
    public function showParticipantRegistration()
    {
        if (Auth::user()) {
            return redirect(route('dashboard'));
        }

        return view('auth.registration.participant');
    }

    /**
     * Returns the registration page for company representatives
     */
    public function showCompanyRegistration()
    {
        if (Auth::user()) {
            return redirect(route('dashboard'));
        }

        return view('auth.registration.company');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Edition;

class RegistrationController extends Controller
{
    /**
     * Returns the registration page for participants
     */
    public function showParticipantRegistration()
    {
        if (!optional(Edition::current())->is_participant_registration_opened) {
            return redirect(route('welcome'))
                ->dangerBanner("You can't register yet.");
        }

        return view('auth.registration.participant');
    }

    /**
     * Returns the registration page for company representatives
     */
    public function showCompanyRegistration()
    {
        if (!optional(Edition::current())->is_company_registration_opened) {
            return redirect(route('welcome'))
                ->dangerBanner("You can't register yet.");
        }

        return view('auth.registration.company');
    }
}

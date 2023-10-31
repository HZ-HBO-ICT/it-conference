<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Adds the authenticated user as a participant in the given presentation
     * @param Presentation $presentation
     * @return mixed
     */
    public function enroll(Presentation $presentation)
    {
        if (!Auth::user()->can('enroll', $presentation)) {
            return redirect()->back()->dangerBanner('You cannot enroll in this presentation');
        }

        Auth::user()->presentations()->attach($presentation);
        return redirect()->back()->banner('You successfully enrolled in this presentation');
    }

    /**
     * Removes the authenticated user as a participant from the given presentation
     * @param Presentation $presentation
     * @return mixed
     */
    public function disenroll(Presentation $presentation)
    {
        if (!Auth::user()->presentations->contains($presentation)) {
            return redirect()->back()->dangerBanner('You are not enrolled in this presentation');
        }

        Auth::user()->presentations()->detach($presentation);

        return redirect()->back()->banner('You successfully disenrolled of this presentation');
    }
}

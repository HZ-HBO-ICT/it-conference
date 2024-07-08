<?php

namespace App\Http\Controllers;

use App\Models\UserPresentation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpeakerController extends Controller
{
    /**
     * Returns the public facing speakers index page
     * @return View
     */
    public function index() : View
    {
        $speakers = UserPresentation::where('role', 'speaker')
            ->get()
            ->sortBy(function($speaker) {
                if ($speaker->user->company && $speaker->user->company->is_sponsorship_approved) {
                    return $speaker->user->company->sponsorship_id;
                }
                return 999; // Assign a high value to non-sponsored speakers
            });

        return view('speakers.index', compact('speakers'));
    }
}

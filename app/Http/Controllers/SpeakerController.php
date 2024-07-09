<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\UserPresentation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpeakerController extends Controller
{
    /**
     * Returns the public facing speakers index page
     *
     * @return View
     */
    public function index(): View
    {
        $speakers = collect();

        if (optional(Edition::current())->is_final_programme_released) {
            $speakers = UserPresentation::where('role', 'speaker')
                ->whereHas('presentation', function($query) {
                    $query->whereNotNull('room_id')
                        ->whereNotNull('timeslot_id');
                })
                ->get()
                ->sortBy(function ($speaker) {
                    if ($speaker->user->company && $speaker->user->company->is_sponsorship_approved) {
                        return $speaker->user->company->sponsorship_id;
                    }
                    return 999; // Assign a high value to non-sponsored speakers
                });
        }

        return view('speakers.index', compact('speakers'));
    }
}

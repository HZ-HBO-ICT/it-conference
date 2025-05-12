<?php

namespace App\Http\Controllers;

use App\Enums\ApprovalStatus;
use App\Models\Edition;
use App\Models\UserPresentation;

class SpeakerController extends Controller
{
    /**
     * Returns the public facing speakers index page
     */
    public function index()
    {
        $edition = Edition::current();
        $query = UserPresentation::where('role', 'speaker');

        if (!$edition) {
            return redirect(route('welcome'))
                ->dangerBanner("Speakers are not available yet.");
        }

        // If the final program is released, filter by room_id and timeslot_id
        if (optional(Edition::current())->is_final_programme_released) {
            $query->whereHas('presentation', function ($query) {
                $query->whereNotNull('room_id')
                    ->whereNotNull('timeslot_id');
            });
        } else {
            // Otherwise, filter by approval
            $query->whereHas('presentation', function ($query) {
                $query->where('approval_status', ApprovalStatus::APPROVED->value);
            });
        }

        $speakers = $query->get()->sortBy(function ($speaker) {
            if ($speaker->user->company && $speaker->user->company->is_sponsorship_approved) {
                return $speaker->user->company->sponsorship_id;
            }
            return 999; // Assign a high value to non-sponsored speakers
        });

        return view('speakers.index', compact('speakers', 'edition'));
    }
}

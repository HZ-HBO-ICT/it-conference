<?php

namespace App\Policies;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class PresentationPolicy
{

    /**
     * Determine whether the user can request for a presentation.
     *
     * @param User $user
     * @return bool
     */
    public function request(User $user): bool
    {
        $currentDate = Carbon::now();
        $deadline = Carbon::createFromDate($currentDate->year, 10, 27);
        $deadline->setTime(12, 0, 0);
        $deadline->setTimezone('Europe/Amsterdam');

        // If the deadline for the 12th of October has passed
        if ($currentDate->gt($deadline)) {
            return false;
        }

        // If the user already is a speaker
        if ($user->speaker) {
            return false;
        }

        if ($user->currentTeam) {
            // Allow HZ to have unlimited presentations
            if ($user->currentTeam->isHz)
                return true;

            return $user->currentTeam->has_presentations_left;
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function update(User $user, Presentation $presentation): bool
    {
        return $user->id == $presentation->mainSpeaker()->user->id;
    }

    /**
     * Determine whether the user can view the presentation details/edits
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function view(User $user, Presentation $presentation): bool
    {
        return $user->speaker && $user->speaker->presentation_id == $presentation->id;
    }

}

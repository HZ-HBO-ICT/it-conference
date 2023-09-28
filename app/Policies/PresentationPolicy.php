<?php

namespace App\Policies;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

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

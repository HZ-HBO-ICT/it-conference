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

}

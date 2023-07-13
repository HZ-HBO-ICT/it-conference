<?php

namespace App\Policies;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PresentationPolicy
{
    /**
     * Allows the user to send a request only if:
     * The user has no other presentation
     * The user is independent or if they are from a team
     * then the team shouldn't have an already existing presentation
     * and the user has been given a speaker role by the company representative
     * (and therefore the user is not the company rep)
     */
    public function sendRequest(User $user): bool
    {
        return is_null($user->speaker)
            && (is_null($user->currentTeam)
                || (is_null($user->currentTeam->presentation())
                    && ($user->hasTeamRole($user->currentTeam, 'speaker')
                        && $user->currentTeam->owner->id !== $user->id)));
    }
}

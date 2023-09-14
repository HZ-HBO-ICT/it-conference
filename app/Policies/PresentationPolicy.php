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
     * or is the company representative themselves
     */
    public function sendRequest(User $user): bool
    {
        return is_null($user->speaker)
            && (is_null($user->currentTeam)
                || (is_null($user->currentTeam->presentations)
                    && ($user->hasTeamRole($user->currentTeam, 'speaker')
                        || $user->currentTeam->owner->id === $user->id
                        && !$user->hasRole('speaker'))));
    }

    /**
     * Allows the user to send a request only if:
     * Their company is the gold sponsor of the conference
     * Their company has less than 2 presentations requested/approved
     * The user is not approved as a global speaker (they don't have approved presentation)
     * The user must not have requested a presentation
     * The user has been given a speaker role by the company representative
     * or is the company representative themselves
     */
    public function sendRequestGoldenSponsor(User $user): bool
    {
        return $user->currentTeam->isGoldenSponsor &&
                $user->currentTeam->allPresentations->count() < 2
                && ($user->hasTeamRole($user->currentTeam, 'speaker')
                    || $user->currentTeam->owner->id === $user->id
                    && !$user->hasRole('speaker'));
    }
}

<?php

namespace App\Actions\Jetstream;

use App\Models\Presentation;
use App\Models\Team;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesTeams;

class DeleteTeam implements DeletesTeams
{
    /**
     * Delete the given team.
     */
    public function delete(Team $team): void
    {
        // First delete the booth of the team
        if ($team->booth)
            $team->booth->delete();

        // Go through all presentations the team has and delete them
        if ($team->allPresentations) {
            $team->allPresentations->each(function (Presentation $presentation) {
                $presentation->fullDelete();
            });
        }

        // All team members have the spatie (global) role of participant only
        if ($team->users) {
            $team->users->each(function (User $user) {
                $user->syncRoles(['participant']);
            });
        }
        if ($team->owner) {
            $team->owner->syncRoles(['participant']);
        }

        // Remove the team and relations between the users and the team
        $team->purge();
    }
}

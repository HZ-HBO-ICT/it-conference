<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Contracts\DeletesTeams;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * The team deleter implementation.
     *
     * @var \Laravel\Jetstream\Contracts\DeletesTeams
     */
    protected $deletesTeams;

    /**
     * Create a new action instance.
     */
    public function __construct(DeletesTeams $deletesTeams)
    {
        $this->deletesTeams = $deletesTeams;
    }

    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        if ($user->speaker) {
            if ($user->speaker->presentation->mainSpeaker()->id == $user->id) {
                // If the user is main speaker, remove the whole presentation
                $user->speaker->presentation->fullDelete();
            } else {
                // If the user is not main speaker, just remove the user from the linking
                $user->speaker->presentation->removeSpeaker($user);
            }
        }

        // If the user has signed up for any presentations, detach him from them
        if ($user->presentations)
            $user->presentations()->detach();

        // If the user owns a team, delete the team, leave the other users active ONLY as participants
        if ($user->ownsTeam($user->currentTeam))
            (new DeleteTeam())->delete($user->currentTeam);

        // Detach all spatie roles just in case
        $user->roles()->detach();

        DB::transaction(function () use ($user) {
            $this->deleteTeams($user);
            $user->deleteProfilePhoto();
            $user->tokens->each->delete();
            $user->delete();
        });
    }

    /**
     * Delete the teams and team associations attached to the user.
     */
    protected function deleteTeams(User $user): void
    {
        $user->teams()->detach();

        $user->ownedTeams->each(function (Team $team) {
            $this->deletesTeams->delete($team);
        });
    }
}

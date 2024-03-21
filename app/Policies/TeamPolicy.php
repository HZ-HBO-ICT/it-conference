<?php

namespace App\Policies;

use App\Mail\CustomTeamInvitation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return $user->belongsToTeam($team);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('content moderator');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->ownsTeam($team) || $user->hasRole('content moderator');
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(User $user, Team $team, $model): bool
    {
        if (get_class($model) == 'App\Models\User') {
            // If they are trying to remove another user, the auth user must be company rep (owner)
            if ($user->ownsTeam($team)) {
                // The user to be removed also needs to be part of the same company and the company rep
                if ($team->hasUser($user) && $team->hasUser($model)) {
                    // If the user is approved speaker, the company rep cannot delete them
                    if ($model->speaker) {
                        return !$model->speaker->is_approved;
                    }

                    // If the user is booth owner, they can be removed
                    return true;
                }
            }
        } elseif (get_class($model) == 'App\Models\TeamInvitation') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can request booth or a sponsorship.
     */
    public function requestBoothOrSponsorship(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can change the logo of the company.
     */
    public function changeLogo(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }
}

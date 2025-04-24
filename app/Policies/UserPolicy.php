<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('viewAny user');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        /*// If the auth user is content moderator they can always delete the user unless the user is themselves
        if ($user->hasRole('content moderator')) {
            return $user->id != $model->id;
        } elseif ($user->id == $model->id) {
            // If the auth user want to remove their own profile
            // If the auth user has no team, therefore is just a participant
            if (!$model->currentTeam) {

                // If the auth user has presentation
                if ($model->speaker)
                    // If the auth user is not approved as a speaker already, they can delete their account
                    return !$model->speaker->is_approved;

                // If they don't have a presentation, they are just a normal participant
                return true;
            }
        }*/

        // If they didn't pass anywhere above, either they are trying to remove another user or
        // they have team, it means they are either company rep, speaker or booth owner,
        // therefore cannot delete themselves;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return true;
    }
}

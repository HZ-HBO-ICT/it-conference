<?php

namespace App\Policies;

use App\Models\User;

class EditionPolicy
{
    /**
     * Determine whether the user can view the list of editions
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny edition');
    }

    /**
     * Determine whether the user can view the edition events
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->hasPermissionTo('view edition');
    }

    /**
     * Determine whether the user can create an edition
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create edition');
    }

    /**
     * Determine whether the user can update the edition
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update edition');
    }

    /**
     * Determine whether the user can delete the edition
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('delete edition');
    }

    /**
     * Determine whether the user can activate the edition
     *
     * @param User $user
     * @return bool
     */
    public function activate(User $user): bool
    {
        return $user->hasPermissionTo('activate edition');
    }
}

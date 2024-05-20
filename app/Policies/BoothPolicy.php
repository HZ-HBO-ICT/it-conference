<?php

namespace App\Policies;

use App\Models\Booth;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoothPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny booth');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booth $booth): bool
    {
        return $user->can('view booth');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create booth');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Booth $booth): bool
    {
        return $user->can('update booth');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booth $booth): bool
    {
        return $user->can('delete booth');
    }

    /**
     * Determine whether the user can view the request for approval status of the
     * model.
     */
    public function viewRequest(User $user, Booth $booth): bool
    {
        return $user->can('view booth request');
    }

    /**
     * Determine whether the user can approve request for the model.
     */
    public function approveRequest(User $user, Booth $booth): bool
    {
        return $user->can('approve booth request');
    }
}

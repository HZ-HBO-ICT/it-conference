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
        return $user->can('view booth list');
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
        return $user->can('edit booth');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booth $booth): bool
    {
        return $user->can('delete booth');
    }

    /**
     * Determine whether the user can view the approval status of the model.
     */
    public function viewApprovalStatus(User $user, Booth $booth): bool
    {
        return $user->can('view booth approval status');
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function approve(User $user, Booth $booth): bool
    {
        return $user->can('edit booth approval status');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Booth $booth): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Booth $booth): bool
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\PresentationType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PresentationTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny presentation type');
    }

    /**
     * Determine whether the user can create the model.
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('create presentation type');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PresentationType $presentationType): bool
    {
        return $user->can('update presentation type');
    }
}

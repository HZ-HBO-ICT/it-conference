<?php

namespace App\Policies;

use App\Models\User;

class FrequentQuestionPolicy
{
    /**
     * Determine whether the user can view the list of faqs
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->can('viewAny frequent question');
    }

    /**
     * Determine whether the user can view the room details/edits
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->can('view frequent question');
    }

    /**
     * Determine whether the user can create a room
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('create frequent question');
    }

    /**
     * Determine whether the user edit room details
     *
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $user->can('update frequent question');
    }

    /**
     * Determine whether the user can delete the room
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->can('delete frequent question');
    }
}

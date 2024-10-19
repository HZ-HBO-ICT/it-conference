<?php

namespace App\Policies;

use App\Models\User;

class FeedbackPolicy
{
    /**
     * Determine whether the user can create feedback
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return !$user->is_crew;
    }
}

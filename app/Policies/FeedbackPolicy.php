<?php

namespace App\Policies;

use App\Models\Feedback;
use App\Models\User;

class FeedbackPolicy
{
    /**
     * Determines whether the user can create feedback
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return !$user->is_crew;
    }

    /**
     * Determines whether the user can view any feedback
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->can('viewAny feedback');
    }

    /**
     * Determines whether the user can view specific feedback
     * @param User $user
     * @param Feedback $feedback
     * @return bool
     */
    public function view(User $user, Feedback $feedback)
    {
        return $user->can('viewAny feedback');
    }
}

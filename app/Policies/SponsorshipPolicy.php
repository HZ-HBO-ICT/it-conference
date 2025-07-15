<?php

namespace App\Policies;

use App\Models\User;

class SponsorshipPolicy
{
    /**
     * Determine whether the user can view the list of sponsorships
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->can('viewAny sponsorship');
    }

    /**
     * Determine whether the user can view the presentation details/edits
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->can('view sponsorship');
    }

    /**
     * Determine whether the user can create a sponsorship
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('create sponsorship');
    }

    /**
     * Determine whether the user can delete the sponsorship
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->can('delete sponsorship');
    }

    /**
     * Determine whether the user can view the sponsorship status
     *
     * @param User $user
     * @return bool
     */
    public function viewRequest(User $user): bool
    {
        return $user->can('view sponsorship request');
    }

    /**
     * Determine whether the user can request sponsorship
     *
     * @param User $user
     * @return bool
     */
    public function createRequest(User $user): bool
    {
        return $user->can('create sponsorship request');
    }

    /**
     * Determine whether the user can approve the sponsorship
     *
     * @param User $user
     * @return bool
     */
    public function approve(User $user): bool
    {
        return $user->can('update sponsorship request');
    }
}

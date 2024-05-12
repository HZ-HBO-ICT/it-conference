<?php

namespace App\Policies;

use App\Models\Edition;
use App\Models\Presentation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class PresentationPolicy
{
    /**
     * Calculates the deadline for signing up for speakers
     * @return Carbon
     */
    public function deadline(): Carbon
    {
        if (Edition::current()) {
            return Edition::current()->getEvent('Presentation request')->end_at;
        } else {
            return Carbon::yesterday();
        }

    }

    /**
     * Determine whether the user can request for a presentation.
     *
     * @param User $user
     * @return bool
     */
    public function request(User $user): bool
    {
        $currentDate = Carbon::now();

        // If the deadline for requesting has passed
        if ($currentDate->gt($this->deadline())) {
            return false;
        }

        // If the user already is a speaker
        if ($user->presenterOf) {
            return false;
        }

        if ($user->company) {
            // Allow HZ to have unlimited presentations
            if ($user->company->isHz) {
                return true;
            }

            return $user->company->has_presentations_left;
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function update(User $user, Presentation $presentation): bool
    {
        $currentDate = Carbon::now();

        // If the user is the content moderator they can always update
        if ($user->hasRole('content moderator')) {
            return true;
        }

        // If the deadline has not passed
        if ($currentDate->lt($this->deadline()) && $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the presentation details/edits
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function view(User $user, Presentation $presentation): bool
    {
        return $user->presenter_of && $user->presenter_of->id == $presentation->id;
    }

    /**
     * Determines whether the user can delete the presentation
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function delete(User $user, Presentation $presentation): bool
    {
        if ($user->hasRole('content moderator')) {
            return $presentation->canBeDeleted();
        }

        if ($user->presenter_of->id == $presentation->id) {
            return !$presentation->isApproved;
        }

        return false;
    }

    /**
     * Determines whether the user can enroll in presentation
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function enroll(User $user, Presentation $presentation): bool
    {
        if (Edition::current()->is_final_programme_released) {
            return $presentation->canEnroll($user);
        }

        return false;
    }
}

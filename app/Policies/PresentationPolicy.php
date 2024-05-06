<?php

namespace App\Policies;

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
        $deadline = Carbon::createFromDate(2024, 10, 27);
        $deadline->setTime(12, 0, 0);
        $deadline->setTimezone('Europe/Amsterdam');

        return $deadline;
    }

    /**
     * Determine whether the user can view the list of presentations
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view presentation list');
    }

    /**
     * Determine whether the user can create a presentation
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('create presentation');
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

        if ($user->can('edit presentation')) {
            return true;
        }

        // If the deadline has not passed
        if ($currentDate->lt($this->deadline()) && ($user->presenter_of->id == $presentation->id)) {
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
     * Determine whether the user can view the presentation status
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function viewApprovalStatus(User $user, Presentation $presentation): bool
    {
        return $user->can('view presentation approval status');
    }

    /**
     * Determine whether the user can approve the presentation
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function approve(User $user, Presentation $presentation): bool
    {
        return $user->can('edit presentation approval status');
    }

    /**
     * Determine whether the user is able to view the crew presentation details/edits
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function crewView(User $user, Presentation $presentation): bool
    {
        return $user->can('view presentation');
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
        if ($user->can('delete presentation')) {
            return $presentation->canBeDeleted();
        }

        if ($user->presenter_of) {
            if ($user->presenter_of->id == $presentation->id) {
                return !$presentation->isApproved;
            }
        }

        return false;
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
     * Determines whether the user can enroll in presentation
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function enroll(User $user, Presentation $presentation): bool
    {
        if (\App\Models\EventInstance::current()->is_final_programme_released) {
            return $presentation->canEnroll($user);
        }

        return false;
    }
}

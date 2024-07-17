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
     * Determine whether the user can view the list of presentations
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->can('viewAny presentation');
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
        if ($user->cannot('view presentation')) {
            return false;
        }

        if ($presentation->company) {
            if ($user->isMemberOf($presentation->company)
                && ($user->isDefaultCompanyMember || $user->hasRole(['pending speaker', 'company representative']))) {
                return true;
            }
        }

        if (!Edition::current()) {
            return $user->is_crew
                || $user->isPresenterOf($presentation);
        }

        return $user->is_crew
            || $user->isPresenterOf($presentation)
            || Edition::current()->is_final_programme_released;
    }

    /**
     * Determine whether the user can create a presentation
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('create presentation') && $user->is_crew;
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
        if ($user->cannot('update presentation')) {
            return false;
        }

        if (!Edition::current()) {
            return $user->is_crew ||
                $user->isPresenterOf($presentation);
        }

        return $user->is_crew ||
            (
                $user->isPresenterOf($presentation)
                && !Edition::current()->is_final_programme_released
            );
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
        if ($user->cannot('delete presentation')) {
            return false;
        }

        // Otherwise, the presenter can delete only if the presentation is not approved yet
        return $user->is_crew
            || $user->isPresenterOf($presentation) && !$presentation->isApproved;
    }

    /**
     * Determine whether the user can request for a presentation.
     *
     * @param User $user
     * @return bool
     */
    public function request(User $user): bool
    {
        if ($user->cannot('create presentation request')) {
            return false;
        }

        // Deny if the deadline for requesting has passed or not arrived yet
        if (Edition::current() && !Edition::current()->is_requesting_presentation_opened) {
            return false;
        }

        // Deny if the user already is a speaker
        if ($user->presenterOf) {
            return false;
        }

        // When the user is associated to a company, allow only if the user's
        // company has presentations left
        if ($user->company) {
            // When the user is not default company member and also not company rep, they should be denied
            if (!$user->isDefaultCompanyMember && !$user->hasRole(['company representative', 'pending speaker'])) {
                return false;
            }

            return $user->company->has_presentations_left;
        }
        // Allow if else
        return true;
    }

    /**
     * Determine whether the user can view the presentation request status
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function viewRequest(User $user, Presentation $presentation): bool
    {
        if ($user->cannot('view presentation request')) {
            return false;
        }

        return $user->is_crew || $user->is_presenter_of($presentation);
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
        return $user->can('update presentation request');
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
        if ($user->cannot('enroll presentation')) {
            return false;
        }

        // decline if the final programme is not released
        if (!Edition::current()->is_final_programme_released) {
            return false;
        }

        // decline if the user is already a participant of this presentation
        if ($user->participating_in->contains($presentation)) {
            return false;
        }

        // decline if the limit of participants was reached
        if ($presentation->remaining_capacity <= 0) {
            return false;
        }

        return $presentation->noConflicts($user);
    }

    /**
     * Determines whether the user can disenroll from the presentation
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function disenroll(User $user, Presentation $presentation): bool
    {
        // decline if the final programme is not released
        if (!Edition::current()->is_final_programme_released) {
            return false;
        }

        // allow if the user is participating in the presentation
        if ($user->participating_in->contains($presentation)) {
            return true;
        }

        return false;
    }

    /**
     * Determines whether the user can become co-speaker to presentation
     *
     * @param User $user
     * @param Presentation $presentation
     * @return bool
     */
    public function joinAsCospeaker(User $user, Presentation $presentation): bool
    {
        return $user->company
            && $presentation->company
            && $presentation->company->id == $user->company->id
            && !$user->presenter_of
            && ($user->isDefaultCompanyMember || $user->hasAnyRole(['pending speaker', 'company representative']));
    }
}

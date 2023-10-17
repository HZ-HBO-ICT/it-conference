<?php

namespace App\Policies;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class PresentationPolicy
{
    private function deadline(): Carbon
    {
        $deadline = Carbon::createFromDate(2023, 10, 27);
        $deadline->setTime(12, 0, 0);
        $deadline->setTimezone('Europe/Amsterdam');

        return $deadline;
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

        // If the deadline for the 27th of October has passed
        if ($currentDate->gt($this->deadline())) {
            return false;
        }

        // If the user already is a speaker
        if ($user->speaker) {
            return false;
        }

        if ($user->currentTeam) {
            // Allow HZ to have unlimited presentations
            if ($user->currentTeam->isHz)
                return true;

            return $user->currentTeam->has_presentations_left;
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

        // If the deadline for the 27th of October has not passed and user is main speaker
        if ($currentDate->lt($this->deadline()) && $user->id == $presentation->mainSpeaker()->user->id) {
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
        return $user->speaker && $user->speaker->presentation_id == $presentation->id;
    }

}

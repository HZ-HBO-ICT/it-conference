<?php

namespace App\Observers;

use App\Models\Team;
use App\Models\User;
use App\Notifications\NotifyBoothApproved;
use App\Notifications\NotifySponsorshipApproved;
use App\Notifications\NotifySponsorshipDisapproved;
use App\Notifications\NotifyTeamApproved;
use App\Notifications\NotifyTeamDisapproved;

class TeamObserver
{
    /**
     * Handle the Team "created" event.
     */
    public function created(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "updated" event.
     */
    public function updated(Team $team): void
    {
        // use $team->getChanges(), i.e. to check if 'is_approved` is changed,
        // it should be a key in the returning associative array
        if (array_key_exists('is_approved', $team->getChanges())
            && $team->is_approved) {

            foreach (User::role('participant')->get() as $user)
            {
                $user->notify(new NotifyTeamApproved($team));
            }
        }

        if (array_key_exists('is_sponsor_approved', $team->getChanges())
            && $team->is_sponsor_approved) {

            foreach (User::role('participant')->get()  as $user) {
                $user->notify(new NotifySponsorshipApproved($team));
            }
        }

        if (array_key_exists('is_sponsor_approved', $team->getChanges())
            && $team->is_sponsor_approved === null) {

            $team->owner->notify(new NotifySponsorshipDisapproved($team));
        }

    }

    /**
     * Handle the Team "deleted" event.
     */
    public function deleted(Team $team): void
    {
        $team->owner->notify(new NotifyTeamDisapproved($team));
    }

    /**
     * Handle the Team "restored" event.
     */
    public function restored(Team $team): void
    {
        //
    }

    /**
     * Handle the Team "force deleted" event.
     */
    public function forceDeleted(Team $team): void
    {
        //
    }
}

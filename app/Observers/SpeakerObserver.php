<?php

namespace App\Observers;

use App\Models\Speaker;
use App\Models\User;
use App\Notifications\NotifyPresentationApproved;
use App\Notifications\NotifyPresentationDisapproved;

class SpeakerObserver
{
    /**
     * Handle the Speaker "created" event.
     */
    public function created(Speaker $speaker): void
    {
        //
    }

    /**
     * Handle the Speaker "updated" event.
     */
    public function updated(Speaker $speaker): void
    {
        // use $speaker->getChanges(), i.e. to check if 'is_approved` is changed,
        // it should be a key in the returning associative array
        if (array_key_exists('is_approved', $speaker->getChanges())
            && $speaker->is_approved && $speaker->is_main_speaker) {

            foreach (User::role('participant')->get() as $user) {
                $user->notify(new NotifyPresentationApproved($speaker->presentation));
            }
        }
    }

    /**
     * Handle the Speaker "deleted" event.
     */
    public function deleted(Speaker $speaker): void
    {
        if ($speaker->is_main_speaker) {
            $speaker->user->notify(new NotifyPresentationDisapproved());
        }
    }

    /**
     * Handle the Speaker "restored" event.
     */
    public function restored(Speaker $speaker): void
    {
        //
    }

    /**
     * Handle the Speaker "force deleted" event.
     */
    public function forceDeleted(Speaker $speaker): void
    {
        //
    }
}

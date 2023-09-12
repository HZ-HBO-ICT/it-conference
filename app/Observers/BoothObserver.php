<?php

namespace App\Observers;

use App\Models\Booth;
use App\Notifications\NotifyBoothApproved;
use App\Notifications\NotifyBoothDisapproved;

class BoothObserver
{
    /**
     * Handle the Booth "created" event.
     */
    public function created(Booth $booth): void
    {
        //
    }

    /**
     * Handle the Booth "updated" event.
     */
    public function updated(Booth $booth): void
    {
        // use $booth->getChanges(), i.e. to check if 'is_approved` is changed,
        // it should be a key in the returning associative array
        if (array_key_exists('is_approved', $booth->getChanges())
            && $booth->is_approved) {
            $booth->team->owner->notify(new NotifyBoothApproved($booth->team));
        }
    }

    /**
     * Handle the Booth "deleted" event.
     */
    public function deleted(Booth $booth): void
    {
        $booth->team->owner->notify(new NotifyBoothDisapproved($booth->team));
    }

    /**
     * Handle the Booth "restored" event.
     */
    public function restored(Booth $booth): void
    {
        //
    }

    /**
     * Handle the Booth "force deleted" event.
     */
    public function forceDeleted(Booth $booth): void
    {
        //
    }
}

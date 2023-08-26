<?php

namespace App\Listeners;

use App\Events\SponsorshipDisapproved;
use App\Mail\SponsorshipDisapprovedMailable;
use App\Notifications\NotifySponsorshipDisapproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleSponsorshipDisapproved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SponsorshipDisapproved $event): void
    {
        $team = $event->team;

        $team->owner->notify(new NotifySponsorshipDisapproved($team));
        $team->is_sponsor_approved = null;
        $team->sponsor_tier_id = null;
        $team->save();
    }
}

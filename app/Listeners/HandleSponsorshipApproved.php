<?php

namespace App\Listeners;

use App\Events\SponsorshipApproved;
use App\Mail\SponsorshipApprovedMailable;
use App\Models\User;
use App\Notifications\NotifySponsorshipApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleSponsorshipApproved
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(SponsorshipApproved $event): void
    {
        $team = $event->team;

        $team->is_sponsor_approved = true;
        $team->save();

        if ($team->booth) {
            if ($team->sponsorTier->name == 'golden') {
                $team->booth->width = 2;
                $team->booth->length = 6;

            } else {
                $team->booth->width = 2;
                $team->booth->length = 4;
            }
            $team->booth->save();
        }

        foreach (User::role('participant')->get() as $user) {
            $user->notify(new NotifySponsorshipApproved($team));
        }
    }
}

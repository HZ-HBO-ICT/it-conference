<?php

namespace App\Listeners;

use App\Events\BoothApproved;
use App\Mail\BoothApprovedMailable;
use App\Notifications\NotifyBoothApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleBoothApproved
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
    public function handle(BoothApproved $event): void
    {
        $booth = $event->booth;

        $booth->is_approved = true;
        $booth->save();

        $booth->team->owner->notify(new NotifyBoothApproved($booth->team));
    }
}

<?php

namespace App\Listeners;

use App\Events\BoothDisapproved;
use App\Notifications\NotifyBoothDisapproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandleBoothDisapproved
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
    public function handle(BoothDisapproved $event): void
    {
        $event->booth->team->owner->notify(new NotifyBoothDisapproved($event->booth->team));
        $event->booth->delete();
    }
}

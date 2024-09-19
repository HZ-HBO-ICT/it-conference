<?php

namespace App\Listeners;

use App\Models\Ticket;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class EmailVerifiedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Create a ticket for the user once their email is verified.
     */
    public function handle(Verified $event): void
    {
        // Create new ticket
        $event->user->createTicket();
    }
}

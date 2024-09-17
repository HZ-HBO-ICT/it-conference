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
        $user = $event->user;

        // Crew members do not need tickets
        if ($user->is_crew) {
            return;
        }

        // Generate unique identifier for the ticket
        $ticketToken = Str::uuid();

        // Create new ticket
        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->token = $ticketToken;
        $ticket->save();
    }
}

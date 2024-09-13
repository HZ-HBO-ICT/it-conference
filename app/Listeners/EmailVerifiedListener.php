<?php

namespace App\Listeners;

use App\Mail\TicketMailable;
use App\Models\Ticket;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        $user = $event->user;

        // Prepare data to pass in qr code
        $ticketToken = Str::uuid();
        $qrCodeData = route('moderator.ticket.scan', [
            'id' => $user->id,
            'ticketToken' => $ticketToken
        ]);

        // Create new ticket
        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->token = $ticketToken;
        $ticket->save();

        // Generate qr code
        $qrCode = QrCode::size(200)
            ->format('png')
            ->merge('/public/img/logo-small-' . $user->role_colour . '.png')
            ->errorCorrection('M')
            ->generate($qrCodeData);

        // Send email to the user with qr code
        Mail::to($user->email)->send(new TicketMailable($qrCode));
    }
}

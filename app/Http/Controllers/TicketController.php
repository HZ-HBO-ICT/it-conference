<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function scan($id, $ticketToken)
    {
        $ticket = Ticket::where([
            'user_id' => $id,
            'token' => $ticketToken
        ])->first();

        if (!$ticket) {
            abort(404);
        }

        if ($ticket->scanned_at) {
            return view('ticket.index', ['message' => 'ticket was already scanned']);
        }

        $ticket->scanned_at = now();
        $ticket->save();

        return view('ticket.index', ['message' => 'successfully scanned']);
    }
}

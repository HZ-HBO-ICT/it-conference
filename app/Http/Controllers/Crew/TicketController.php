<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Execute logic behind scanning the ticket
     *
     * @param $id
     * @param $ticketToken
     * @return View
     */
    public function scan($id, $ticketToken): View
    {
        if (Auth::user()->cannot('scan', Ticket::class)) {
            abort(403);
        }

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

<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(): View
    {
        if (Auth::user()->cannot('scan', Ticket::class)) {
            abort(403);
        }

        return view('crew.tickets.index');
    }

    /**
     * Execute logic behind scanning the tickets
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
            return view('tickets.index', [
                'message' => 'Ticket was already scanned',
                'user' => $ticket->user,
            ]);
        }

        $ticket->scanned_at = now();
        $ticket->save();

        return view('tickets.index', [
            'message' => 'tickets successfully scanned',
            'user' => $ticket->user
        ]);
    }
}

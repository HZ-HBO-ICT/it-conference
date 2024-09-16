<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Render index page
     *
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()->cannot('scan', Ticket::class)) {
            abort(403);
        }

        return view('crew.tickets.index');
    }
}

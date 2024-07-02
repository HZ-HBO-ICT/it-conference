<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Edition;
use App\Models\EditionEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EditionEventController extends Controller
{
    /**
     * Returns the index page of events for the particular edition
     *
     * @param Edition $edition to retrieve events from
     * @return View
     */
    public function index(Edition $edition) : View
    {
        if (Auth::user()->cannot('view', Edition::class)) {
            abort(403);
        }

        $events = $edition->editionEvents;

        return view('moderator.events.index', compact('edition', 'events'));
    }
}

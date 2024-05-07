<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\EditionEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditionEventController extends Controller
{
    /**
     * Returns the index page of events for the particular edition
     * @param Edition $edition to retrieve events from
     * @return View
     */
    public function index(Edition $edition) : View
    {
        $events = $edition->editionEvents;

        return view('moderator.events.index', compact('edition', 'events'));
    }

    public function create(): View {
        return view('moderator.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $edition = EditionEvent::create($request->validate(EditionEvent::rules()));

        return redirect(route('moderator.events.index', compact('edition')));
    }
}

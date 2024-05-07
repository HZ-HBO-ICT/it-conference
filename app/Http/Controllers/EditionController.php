<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\EditionEvent;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditionController extends Controller
{
    /**
     * Returns the landing page
     * @return View
     */
    public function index() : View
    {
        $editions = Edition::all();

        return view('moderator.editions.index', compact('editions'));
    }

    /**
     * Returns create form for the editions
     * @return View
     */
    public function create() : View
    {
        return view('moderator.editions.create');
    }

    /**
     * Creates new instance of Edition and stores in the database
     * @param Request $request data about the edition
     * @return RedirectResponse redirects to show page
     */
    public function store(Request $request) : RedirectResponse
    {
        $edition = Edition::create($request->validate(Edition::rules()));

        foreach (Event::all() as $event) {
            EditionEvent::create([
                'event_id' => $event->id,
                'edition_id' => $edition->id,
            ]);
        }

        return redirect(route('moderator.events.index', compact('edition')));
    }

    /**
     * Triggers a function for a specific edition that activates it
     * @param Edition $edition to activate
     * @return RedirectResponse redirects to the index page
     */
    public function activateEdition(Edition $edition) : RedirectResponse
    {
        // if all the dates for edition are present, it can be activated
        if ($edition->configured()) {
            $edition->activate();
        }

        return redirect(route('moderator.editions.index'));
    }

    /**
     * Deletes a record of a particular edition in the database
     * @param Edition $edition
     * @return RedirectResponse redirects to index page
     */
    public function destroy(Edition $edition) : RedirectResponse
    {
        $edition->delete();

        return redirect(route('moderator.editions.index'));
    }
}

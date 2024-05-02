<?php

namespace App\Http\Controllers;

use App\Models\Edition;
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
     * Returns the show page for the particular edition
     * @param Edition $edition to show
     * @return View
     */
    public function show(Edition $edition) : View
    {
        $events = $edition->editionEvents;

        return view('moderator.editions.show', compact('edition', 'events'));
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

        return redirect(route('moderator.editions.show', compact('edition')));
    }

    /**
     * Triggers a function for a specific edition that activates it
     * @param Edition $edition to activate
     * @return RedirectResponse redirects to the index page
     */
    public function activateEdition(Edition $edition) : RedirectResponse
    {
        $edition->activate();

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

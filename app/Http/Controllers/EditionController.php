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
     * @param int $id of the edition to retrieve
     * @return View
     */
    public function show(int $id) : View
    {
        $edition = Edition::findOrFail($id);
        $events = $edition->editionEvents;

        return view('moderator.editions.show', [
            'edition' => $edition,
            'events' => $events,
        ]);
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
        $edition = Edition::create($this->validateEdition($request));

        return redirect(route('moderator.editions.show', compact('edition')));
    }

    /**
     * Triggers a function for a specific edition that activates it
     * @param int $id of the edition
     * @return RedirectResponse redirects to the index page
     */
    public function activateEdition(int $id) : RedirectResponse
    {
        Edition::findOrFail($id)->activate();

        return redirect(route('moderator.editions.index'));
    }

    /**
     * Deletes a record of a particular edition in the database
     * @param int $id of the edition
     * @return RedirectResponse redirects to index page
     */
    public function destroy(int $id) : RedirectResponse
    {
        Edition::findOrFail($id)->delete();

        return redirect(route('moderator.editions.index'));
    }
}

<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Models\Edition;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EditionController extends Controller
{
    /**
     * Returns the landing page
     *
     * @return View
     */
    public function index() : View
    {
        if (Auth::user()->cannot('viewAny', Edition::class)) {
            abort(403);
        }

        $editions = Edition::all();

        return view('moderator.editions.index', compact('editions'));
    }

    /**
     * Returns create form for the editions
     *
     * @return View
     */
    public function create() : View
    {
        if (Auth::user()->cannot('create', Edition::class)) {
            abort(403);
        }

        return view('moderator.editions.create');
    }

    /**
     * Creates new instance of Edition and stores in the database
     *
     * @param Request $request data about the edition
     * @return RedirectResponse redirects to show page
     */
    public function store(Request $request) : RedirectResponse
    {
        if (Auth::user()->cannot('create', Edition::class)) {
            abort(403);
        }

        $edition = Edition::create($request->validate(Edition::rules()));

        // attach all the default events to a new edition
        foreach (Event::all() as $event) {
            $edition->addEvent($event);
        }

        return redirect(route('moderator.events.index', compact('edition')))
            ->banner("Edition {$edition->name} was successfully created");
    }

    /**
     * Triggers a function for a specific edition that activates it
     *
     * @param Edition $edition to activate
     * @return RedirectResponse redirects to the index page
     */
    public function activateEdition(Edition $edition) : RedirectResponse
    {
        if (Auth::user()->cannot('activate', Edition::class)) {
            abort(403);
        }

        // if all the dates for edition are present, it can be activated
        if ($edition->configured()) {
            $edition->activate();
        }

        return redirect(route('moderator.editions.index'))
            ->banner("Edition {$edition->name} was successfully activated");
    }

    /**
     * Deletes a record of a particular edition in the database
     *
     * @param Edition $edition
     * @return RedirectResponse redirects to index page
     */
    public function destroy(Edition $edition) : RedirectResponse
    {
        if (Auth::user()->cannot('delete', Edition::class)) {
            abort(403);
        }

        $edition->delete();

        return redirect(route('moderator.editions.index'))
            ->banner("Edition {$edition->name} was successfully deleted");
    }
}

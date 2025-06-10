<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Presentation;
use App\Models\PresentationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PresentationController extends Controller
{
    /**
     * Returns the page to request a presentation
     *
     * @return View
     */
    public function create(): View
    {
        $presentationTypes = optional(Edition::current())->presentationTypes;
        if (Auth::user()->cannot('request', Presentation::class)) {
            abort(403);
        }

        return view('presentations.create', compact('presentationTypes'));
    }

    /**
     * Processes the request for presentation
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->cannot('request', Presentation::class)) {
            abort(403);
        }

        $presentation = Presentation::create($request->validate(Presentation::rules()));

        if ($user->company) {
            $presentation->update(['company_id' => $user->company->id]);
        }

        $user->joinPresentation($presentation, 'speaker');
        $user->refresh();

        return redirect(route('presentations.show', $presentation))
            ->banner("We successfully received your request to host a {$presentation->type}");
    }

    /**
     * Return the basic show page for the presentation
     *
     * @param Presentation $presentation
     * @return View
     */
    public function show(Presentation $presentation): View
    {
        if (Auth::user()->cannot('view', $presentation)) {
            abort(403);
        }

        return view('presentations.show', compact('presentation'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentation $presentation)
    {
        if (Auth::user()->cannot('delete', $presentation)) {
            abort(403);
        }

        $presentation->delete();

        return redirect(route('dashboard'))
            ->banner('You deleted your presentation request successfully');
    }
}

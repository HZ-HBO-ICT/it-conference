<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PresentationController extends Controller
{
    /**
     * Returns the page to request a presentataion
     * @return View
     */
    public function create(): View
    {
        Auth::user()->can('request', Presentation::class);

        return view('presentations.create');
    }

    /**
     * Processes the request for presentation
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $user->can('request', Presentation::class);

        $presentation =
            Presentation::create($request->validate(Presentation::rules()));

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
     * @param Presentation $presentation
     * @return View
     */
    public function show(Presentation $presentation): View
    {
        if (Auth::user()->can('view', $presentation)) {
            return view('presentations.show', compact('presentation'));
        }

        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentation $presentation)
    {
        Auth::user()->can('delete', $presentation);

        $presentation->delete();

        return redirect(route('dashboard'))
            ->banner('You deleted your presentation request successfully');
    }
}

<?php

namespace App\Http\Controllers\Hub;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    /**
     * Displays the view of the personal programme for the participant
     *
     * @return View
     */
    public function programme(): View
    {
        $presentations = Auth::user()->participating_in->sortBy('start');

        return view('myhub.programme', compact('presentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createFeedback()
    {
        if (Auth::user()->cannot('create', Feedback::class)) {
            abort(403);
        }

        return view('myhub.feedback');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeFeedback(Request $request)
    {
        if (Auth::user()->cannot('create', Feedback::class)) {
            abort(403);
        }

        $validated = $request->validate(Feedback::$rules);
        Feedback::create(array_merge(
            $validated,
            ['reported_by_id' => Auth::user()->id]
        ));

        return redirect(route('dashboard'))->banner('You successfully submitted your feedback!');
    }

    /**
     * Used to determine the view that the user will have if they are able to switch it
     * @return RedirectResponse
     */
    public function switchView() : RedirectResponse
    {
        if (!optional(Auth::user())->canSwitchViews()) {
            abort(403);
        }

        session(['showCompanyView' => !session('showCompanyView', false)]);

        return redirect(route('dashboard'));
    }
}

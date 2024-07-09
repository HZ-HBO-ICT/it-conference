<?php

namespace App\Http\Controllers\Crew;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePresentationRequest;
use App\Mail\PresentationApprovedMailable;
use App\Mail\PresentationDisapprovedMailable;
use App\Models\Company;
use App\Models\Presentation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        if (Auth::user()->cannot('viewAny', Presentation::class)) {
            abort(403);
        }

        $presentations = Presentation::orderBy('is_approved')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('crew.presentations.index', compact('presentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('create', Presentation::class)) {
            abort(403);
        }

        // Also possible to use the relationship with UserPresentation,
        // but as a personal choice I'd rather stick to isolating that
        $users = User::all()->filter(function ($user) {
            return is_null($user->presenter_of) && $user->hasRole('participant');
        });

        return view('crew.presentations.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentationRequest $request)
    {
        if (Auth::user()->cannot('create', Presentation::class)) {
            abort(403);
        }

        $validated = $request->validated();

        $presentation = Presentation::create($request->validate(Presentation::rules()));

        $user = User::find($validated['user_id']);
        $user->joinPresentation($presentation, 'speaker');

        if ($user->company) {
            $presentation->company_id = $user->company->id;
            $presentation->save();
            $presentation->fresh();
        }

        return redirect(route('moderator.presentations.index'))
            ->banner('You successfully added a new presentation');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Presentation $presentation): View
    {
        if (Auth::user()->cannot('view', $presentation)) {
            abort(403);
        }

        return view('crew.presentations.show', compact('presentation'));
    }

    /**
     * Approve or reject the specified resource in storage.
     */
    public function approve(Request $request, Presentation $presentation)
    {
        if (Auth::user()->cannot('approve', $presentation)) {
            abort(403);
        }

        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        if (!$isApproved) {
            foreach ($presentation->speakers as $speaker) {
                Mail::to($speaker->email)->send(new PresentationDisapprovedMailable);
            }
        }

        $presentation->handleApproval($isApproved);

        $template = $isApproved ? 'You approved the presentation to take place during the IT Conference!'
            : 'You refused the request to host this presentation during the IT conference';

        if ($isApproved) {
            foreach ($presentation->speakers as $speaker) {
                Mail::to($speaker->email)->send(new PresentationApprovedMailable);
            }

            return redirect(route('moderator.presentations.show', $presentation))
                ->banner(__($template));
        } else {
            return redirect(route('moderator.presentations.index'))
                ->banner(__($template));
        }
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

        return redirect(route('moderator.presentations.index'))
            ->banner('You deleted the presentation successfully');
    }
}

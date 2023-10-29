<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\Presentation;
use App\Models\Speaker;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        // Sort them so the presentations that await approval appear on top
        $presentations = Presentation::with(['speakers' => function ($query) {
            $query->orderBy('is_approved');
        }])->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('moderator.presentations.index', compact('presentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: Make better filter on people who cannot be speakers
        $users = User::doesntHave('speaker')->get();

        return view('moderator.presentations.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'difficulty_id' => 'required|numeric',
            'max_participants' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        $presentation = Presentation::create($request->validate(Presentation::rules()));

        $user = User::find($validated['user_id']);

        Speaker::create([
            'user_id' => $user->id,
            'presentation_id' => $presentation->id,
            'is_main_speaker' => 1,
            'is_approved' => 1
        ]);

        if ($user->currentTeam) {
            if ($user->currentTeam->owner->id === $user->id) {
                $user->currentTeam->users()->attach(
                    $user, ['role' => 'speaker']
                );
                $user->setRelations([]);
            }
        }

        return redirect(route('moderator.presentations.index'))
            ->banner('You successfully added a new presentation');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Presentation $presentation): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('moderator.presentations.show', compact('presentation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presentation $presentation)
    {
        //
    }

    /**
     * Approve or reject the specified resource in storage.
     */
    public function approve(Request $request, Presentation $presentation)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        $mainSpeakerName = $presentation->mainSpeaker()->user->name;
        $presentation->handleApproval($isApproved);

        $template = $isApproved ? 'You approved :name to host a presentation during the IT Conference!'
            : 'You refused the request of :name to host presentation during the IT conference';
        return redirect(route('moderator.presentations.index'))
            ->banner(__($template, ['name' => $mainSpeakerName]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presentation $presentation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentation $presentation)
    {
        $this->authorize('delete', $presentation);

        $presentation->fullDelete();

        return redirect(route('moderator.presentations.index'))
            ->banner('You deleted the presentation successfully');
    }
}

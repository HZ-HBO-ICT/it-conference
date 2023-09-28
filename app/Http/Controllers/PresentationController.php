<?php

namespace App\Http\Controllers;

use App\Models\EventInstance;
use App\Models\Presentation;
use App\Models\Speaker;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentationController extends Controller
{

    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $presentations = Presentation::join('speakers', 'speakers.presentation_id', '=', 'presentations.id')
            ->orderBy('speakers.is_approved')->paginate(15);
        return view('moderator.requests.presentations', compact('presentations'));

    }

    public function create()
    {
        $this->authorize('request', Presentation::class);

        return view('speakers.presentation.create');
    }

    public function store(Request $request)
    {
        $this->authorize('request', Presentation::class);

        if (Auth::user()->currentTeam) {
            if (Auth::user()->currentTeam->owner->id === Auth::user()->id) {
                Auth::user()->currentTeam->users()->attach(
                    Auth::user(), ['role' => 'speaker']
                );
            }
        }

        $presentation =
            Presentation::create($request->validate(Presentation::rules()));

        Auth::user()->setRelations([]);

        if (Auth::user()->currentTeam) {
            foreach (Auth::user()->currentTeam->allSpeakers as $speaker) {
                Speaker::create([
                    'user_id' => $speaker->id,
                    'presentation_id' => $presentation->id,
                    'is_main_speaker' => Auth::user()->id == $speaker->id ? 1 : 0,
                    'is_approved' => 0,
                ]);
            }
        } else {
            Speaker::create([
                'user_id' => Auth::user()->id,
                'presentation_id' => $presentation->id,
                'is_main_speaker' => 1,
                'is_approved' => 0,
            ]);
        }

        return redirect(route('presentations.show', $presentation))->banner("You successfully send your request to host a {$presentation->type}");
    }

    public function show(Presentation $presentation)
    {
        // TODO one route should return one view. This should be split up into two different routes
        // Shows the view to the host of the presentation
        if (Auth::user()->id == $presentation->mainSpeaker()->user->id)
            return view('speakers.presentation.show', compact('presentation'));

        // To everyone else once the programme is released
        if (!EventInstance::current()->is_final_programme_released)
            abort(404);

        return view('presentations.show', compact('presentation'));
    }

    public function edit(Presentation $presentation)
    {
        $this->authorize('update', $presentation);

        return view('speakers.presentation.edit', compact('presentation'));
    }

    public function update(Presentation $presentation, Request $request)
    {
        $this->authorize('update', $presentation);

        $presentation->update($request->validate(Presentation::rules()));

        return redirect(route('presentations.show', $presentation))->banner("You successfully updated your presentation");
    }
}

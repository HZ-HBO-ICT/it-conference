<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Presentation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class ReplacePresentation extends Component
{
    public Presentation $presentationToBeReplaced;
    public $availablePresentations;
    public $newPresentationId;

    /**
     * Triggered on initializing the component
     * @return void
     */
    public function mount()
    {
        $this->availablePresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled
                && $presentation->type == $this->presentationToBeReplaced->type;
        });

        if ($this->availablePresentations->count() > 0) {
            $this->newPresentationId = $this->availablePresentations->first()->id;
        }
    }

    /**
     * Replaces the presentation that has been passed with the one chosen -> detaches
     * all participants of the replaced participants as well
     * @return RedirectResponse
     */
    public function replace()
    {
        $newPresentation = Presentation::find($this->newPresentationId);
        if (is_null($newPresentation)) {
            return redirect(route('moderator.schedule.presentation', $this->presentationToBeReplaced))
                ->with(
                    'error',
                    'An issue occurred with replacement of the presentation.
                    Please try again later or contact the dev team'
                );
        }

        $newPresentation->room_id = $this->presentationToBeReplaced->room_id;
        $newPresentation->timeslot_id = $this->presentationToBeReplaced->timeslot_id;
        $newPresentation->save();

        $this->presentationToBeReplaced->room_id = null;
        $this->presentationToBeReplaced->timeslot_id = null;
        $this->presentationToBeReplaced->participants()->detach();
        $this->presentationToBeReplaced->save();

        return redirect()->to(route('moderator.schedule.index'));
    }

    /**
     * Renders the component
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function render()
    {
        return view('moderator.schedule.presentations.replace-presentation');
    }
}

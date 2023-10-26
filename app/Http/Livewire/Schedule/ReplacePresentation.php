<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Presentation;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class ReplacePresentation extends Component
{
    public Presentation $presentationToBeReplaced;

    public $availablePresentations;
    public $newPresentationId;

    public function mount()
    {
        $this->availablePresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled
                && $presentation->type == $this->presentationToBeReplaced->type;
        });

        if($this->availablePresentations->count() > 0)
            $this->newPresentationId = $this->availablePresentations->first()->id;
    }

    /**
     * Replaces the presentation that has been passed with the one chosen -> detaches
     * all participants of the replaced participants as well
     * @return RedirectResponse
     */
    public function replace()
    {
        $newPresentation = Presentation::find($this->newPresentationId);
        $newPresentation->room_id = $this->presentationToBeReplaced->room_id;
        $newPresentation->timeslot_id = $this->presentationToBeReplaced->timeslot_id;
        $newPresentation->save();

        $this->presentationToBeReplaced->room_id = null;
        $this->presentationToBeReplaced->timeslot_id = null;
        $this->presentationToBeReplaced->participants()->detach();
        $this->presentationToBeReplaced->save();

        return redirect()->to(route('moderator.schedule.overview'));
    }

    public function render()
    {
        return view('moderator.schedule.replace-presentation');
    }
}

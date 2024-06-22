<?php

namespace App\Livewire\Presentation;

use App\Models\Presentation;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class JoinAsSpeakerModal extends ModalComponent
{
    public Presentation $presentation;

    /**
     * Initializes the component
     * @param Presentation $presentation
     * @return void
     */
    public function mount(Presentation $presentation)
    {
        $this->presentation = $presentation;
    }

    /**
     * Saves the updates made on the form
     */
    public function save()
    {
        $this->authorize('joinAsCospeaker', $this->presentation);

        Auth::user()->joinPresentation($this->presentation, 'speaker');

        if (Auth::user()->presenter_of) {
            return redirect(route('presentations.show', $this->presentation))
                ->with('status', 'Presentation successfully updated.');
        } else {
            return redirect(route('moderator.presentations.show', $this->presentation))
                ->with('status', 'Presentation successfully updated.');
        }
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.presentation.join-as-speaker-modal');
    }
}

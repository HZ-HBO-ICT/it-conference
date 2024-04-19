<?php

namespace App\Livewire\Presentation;

use App\Livewire\Forms\PresentationForm;
use App\Models\Presentation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class EditPresentationModal extends Component
{
    public bool $isOpen = false;
    public Presentation $presentation;
    public PresentationForm $form;

    /**
     * Initializes the component
     * @param Presentation $presentation
     * @return void
     */
    public function mount(Presentation $presentation)
    {
        $this->presentation = $presentation;
        $this->form->setCompany($presentation);
    }

    /**
     * Saves the updates made on the form
     * @return RedirectResponse
     */
    public function save() : RedirectResponse
    {
        $this->validate();

        $this->form->update();

        if (Auth::user()->presenter_of->id == $this->presentation->id) {
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
        return view('livewire.presentation.edit-presentation-modal');
    }
}

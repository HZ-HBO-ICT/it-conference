<?php

namespace App\Livewire\Presentation;

use App\Livewire\Forms\PresentationForm;
use App\Models\Presentation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditPresentationModal extends ModalComponent
{
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
     */
    public function save()
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
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '3xl';
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
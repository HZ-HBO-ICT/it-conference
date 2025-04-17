<?php

namespace App\Livewire\Presentation;

use App\Jobs\NotifyPresentationRoles;
use App\Livewire\Forms\PresentationForm;
use App\Mail\PresentationUpdatedMailable;
use App\Models\Presentation;
use App\Models\PresentationType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditPresentationModal extends ModalComponent
{
    public Presentation $presentation;

    public PresentationForm $form;

    /** @var Collection<int, PresentationType> */
    public $presentationTypes;


    /**
     * Initializes the component
     * @param Presentation $presentation
     * @return void
     */
    public function mount(Presentation $presentation)
    {
        $this->presentationTypes = PresentationType::all();
        $this->presentation = $presentation;
        $this->form->setCompany($presentation);
    }

    /**
     * Saves the updates made on the form
     */
    public function save()
    {
        $this->authorize('update', $this->presentation);

        $this->validate();

        $this->form->update();

        if (Auth::user()->presenter_of) {
            if (!$this->presentation->isSamePresentation($this->form->presentation)) {
                NotifyPresentationRoles::dispatch('crew', $this->presentation, PresentationUpdatedMailable::class);
            }

            return redirect(route('presentations.show', $this->presentation))
                ->with('status', 'Presentation successfully updated.');
        } else {
            if (!$this->presentation->isSamePresentation($this->form->presentation)) {
                NotifyPresentationRoles::dispatch('speaker', $this->presentation, PresentationUpdatedMailable::class);
            }

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
        return '6xl';
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

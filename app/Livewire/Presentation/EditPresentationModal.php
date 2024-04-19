<?php

namespace App\Livewire\Presentation;

use App\Livewire\Forms\PresentationForm;
use App\Models\Presentation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditPresentationModal extends Component
{
    public bool $isOpen = false;
    public Presentation $presentation;
    public PresentationForm $form;

    public function mount(Presentation $presentation)
    {
        $this->presentation = $presentation;
        $this->form->setCompany($presentation);
    }

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

    public function render()
    {
        return view('livewire.presentation.edit-presentation-modal');
    }
}

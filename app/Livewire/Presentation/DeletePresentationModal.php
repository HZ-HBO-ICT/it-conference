<?php

namespace App\Livewire\Presentation;

use App\Models\Presentation;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeletePresentationModal extends ModalComponent
{
    public Presentation $presentation;

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.presentation.delete-presentation-modal');
    }
}

<?php

namespace App\Livewire\Edition;

use App\Models\Edition;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class ActivateEditionModal extends ModalComponent
{
    public Edition $edition;

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.edition.activate-edition-modal');
    }
}

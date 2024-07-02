<?php

namespace App\Livewire\Edition;

use App\Models\Edition;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteEditionModal extends ModalComponent
{
    public Edition $edition;

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.edition.delete-edition-modal');
    }
}

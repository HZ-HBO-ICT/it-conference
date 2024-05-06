<?php

namespace App\Livewire\Booth;

use App\Models\Booth;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteBoothModal extends ModalComponent
{
    public Booth $booth;

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.booth.delete-booth-modal');
    }
}

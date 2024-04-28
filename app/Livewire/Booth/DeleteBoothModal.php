<?php

namespace App\Livewire\Booth;

use App\Models\Booth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteBoothModal extends ModalComponent
{
    public Booth $booth;

    public function render()
    {
        return view('livewire.booth.delete-booth-modal');
    }
}

<?php

namespace App\Livewire\QrCode;

use LivewireUI\Modal\ModalComponent;

class Scanner extends ModalComponent
{
    public function render()
    {
        $this->dispatch('enableScanner');
        return view('livewire.qr-code.scanner');
    }
}

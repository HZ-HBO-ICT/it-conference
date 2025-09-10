<?php

namespace App\Livewire\QrCode;

use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class Scanner extends ModalComponent
{
    /**
     * Render the component
     *
     * @return View
     */
    public function render(): View
    {
        $this->dispatch('enableScanner');

        return view('livewire.qr-code.scanner');
    }
}

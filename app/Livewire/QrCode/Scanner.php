<?php

namespace App\Livewire\QrCode;

use Livewire\Component;

class Scanner extends Component
{
    public $scannedCode;

    public function handleScannedCode($code) {
        $this->scannedCode = $code;

        $this->emit('codeProcessed', $code);
    }

    public function render()
    {
        return view('livewire.qr-code.scanner');
    }
}

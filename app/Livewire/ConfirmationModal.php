<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ConfirmationModal extends ModalComponent
{
    public $title;
    public $method;
    public $route;
    public $isApproved;
    public ?string $callToAction;

    public function render()
    {
        return view('livewire.confirmation-modal');
    }
}

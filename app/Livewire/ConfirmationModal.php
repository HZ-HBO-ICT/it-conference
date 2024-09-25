<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ConfirmationModal extends ModalComponent
{
    public $title;
    public $method;
    public $route;
    public $entity;
    public $isApproved;
    public $entityRouteParamType;
    public $callToAction;

    public function render()
    {
        return view('livewire.confirmation-modal');
    }
}

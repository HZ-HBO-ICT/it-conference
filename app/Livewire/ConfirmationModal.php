<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ConfirmationModal extends ModalComponent
{
    public $title;
    public $method;
    public $route;
    public $isApproved;
    public ?string $callToAction;

    /**
     * Renders the component
     *
     * @return View
     */
    public function render() : View
    {
        return view('livewire.confirmation-modal');
    }
}

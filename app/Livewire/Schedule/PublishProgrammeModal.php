<?php

namespace App\Livewire\Schedule;

use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PublishProgrammeModal extends ModalComponent
{
    /**
     * Renders the component
     *
     * @return View
     */
    public function render() : View
    {
        return view('livewire.schedule.publish-programme-modal');
    }
}

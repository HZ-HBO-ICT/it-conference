<?php

namespace App\Http\Livewire\Presentations;

use App\Models\Presentation;
use App\Models\User;
use Livewire\Component;

class DeletePresentationForm extends Component
{
    public Presentation $presentation;

    public bool $confirmingDeletion = false;

    /**
     * Trigger the confirmation modal to be visible
     *
     * @return void
     */
    public function confirmDeletion()
    {
        $this->confirmingDeletion = true;
    }

    public function render()
    {
        return view('presentations.delete-presentation-form');
    }
}

<?php

namespace App\Http\Livewire\Presentations;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
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

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('presentations.delete-presentation-form');
    }
}

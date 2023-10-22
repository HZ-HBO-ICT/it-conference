<?php

namespace App\Http\Livewire\Booths;

use App\Models\Booth;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class DeleteBoothForm extends Component
{
    /**
     * @var Booth the Team that must be deleted
     */
    public Booth $booth;

    /**
     * @var bool determines whether the confirmation modal is visible
     */
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
     * Render this component
     *
     * @return Factory|Application|View|ApplicationContract
     */
    public function render(): Factory|Application|View|ApplicationContract
    {
        return view('moderator.booths.delete-booth-form');
    }
}

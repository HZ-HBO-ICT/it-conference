<?php

namespace App\Http\Livewire\Sponsorships;

use App\Models\Team;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;

class DeleteSponsorshipForm extends Component
{
    /**
     * @var Team the Team that must be deleted
     */
    public Team $team;

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
        return view('moderator.sponsors.delete-sponsorship-form');
    }
}

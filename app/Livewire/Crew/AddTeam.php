<?php

namespace App\Livewire\Crew;

use App\Models\User;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class AddTeam extends ModalComponent
{
    public User $user;
    public $crew_team;

    /**
     * Initializes the component
     * @param User $user
     * @return void
     */
    public function mount(User $user)
    {
        $this->user = $user;
        $this->crew_team = $user->crew_team;
    }

    /**
     * Saves the tag for the user
     */
    public function save()
    {
        $validated = $this->validate([
            'crew_team' => 'required|in:organization,website'
        ]);

        $this->user->update([
            'crew_team' => $this->crew_team
        ]);

        return redirect()->to(route('moderator.crew.index'));
    }

    /**
     * Removes the set team of the crew user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeTeam()
    {
        $this->user->update([
            'crew_team' => null
        ]);

        return redirect()->to(route('moderator.crew.index'));
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.crew.add-team');
    }
}

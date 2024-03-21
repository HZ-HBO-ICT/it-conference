<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditTeamModal extends Component
{
    public Team $team;

    protected $rules = [
        'team.name' => 'required',
        'team.description' => 'required',
        'team.website' => 'required',
        'team.postcode' => ['required',
            'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
        'team.house_number' => ['required',
            'regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'],
        'team.street' => 'required',
        'team.city' => 'required'
    ];

    /**
     * Triggered on initializing of the component
     * @param Team $team
     * @return void
     */
    public function mount(Team $team)
    {
        $this->team = $team;
    }

    /**
     * Saves the updates made on the company as redirects
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function save()
    {
        $this->validate();

        $this->team->save();

        if (Auth::user()->ownsTeam($this->team)) {
            return redirect(route('teams.show', $this->team))
                ->with('status', 'Company successfully updated.');
        } else {
            return redirect(route('moderator.companies.show', $this->team))
                ->with('status', 'Company successfully updated.');
        }
    }

    /**
     * Renders the component
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('teams.edit-team-modal');
    }
}

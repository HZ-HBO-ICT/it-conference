<?php

namespace App\Http\Livewire;

use App\Models\Team;
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

    public function mount(Team $team)
    {
        $this->team = $team;
    }

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

    public function render()
    {
        return view('teams.edit-team-modal');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class EditTeamForm extends Component
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
        session()->flash('message', 'The company details are successfully updated.');
    }

    public function render()
    {
        return view('teams.edit-team-form');
    }
}

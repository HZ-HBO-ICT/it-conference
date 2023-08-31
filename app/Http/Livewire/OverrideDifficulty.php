<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OverrideDifficulty extends Component
{
    public $presentation;
    public $selectedDifficultyId;

    protected $rules = [
        'selectedDifficultyId' => 'required'
    ];

    public function mount($presentation)
    {
        $this->presentation = $presentation;
        $this->selectedDifficultyId = $presentation->difficulty->id;
    }

    public function updateDifficulty()
    {
        $this->presentation->update([
            'difficulty_id' => $this->selectedDifficultyId
        ]);

        session()->flash('message', 'The difficulty level is successfully updated.');
    }

    public function render()
    {
        return view('livewire.override-difficulty');
    }
}

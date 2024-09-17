<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Livewire\Component;

class OverrideDifficulty extends Component
{
    public $presentation;
    public $selectedDifficultyId;

    protected $rules = [
        'selectedDifficultyId' => 'required'
    ];

    /**
     * Triggered when initializing the component
     * @param $presentation
     * @return void
     */
    public function mount($presentation)
    {
        $this->presentation = $presentation;
        $this->selectedDifficultyId = $presentation->difficulty->id;
    }

    /**
     * Saves changes on the difficulty level
     * @return void
     */
    public function updateDifficulty()
    {
        $this->presentation->update([
            'difficulty_id' => $this->selectedDifficultyId
        ]);

        session()->flash('message', 'The difficulty level is successfully updated.');
    }

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.override-difficulty');
    }
}

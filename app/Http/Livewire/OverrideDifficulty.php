<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class OverrideDifficulty extends Component
{
    public $presentation;
    public $selectedDifficultyId;

    protected array $rules = [
        'selectedDifficultyId' => 'required'
    ];

    /**
     * @param $presentation
     * @return void
     */
    public function mount($presentation)
    {
        $this->presentation = $presentation;
        $this->selectedDifficultyId = $presentation->difficulty->id;
    }

    /**
     * TODO: Unused function
     * Updates the presentation's difficulty.
     * @return void
     */
    public function updateDifficulty(): void
    {
        $this->presentation->update([
            'difficulty_id' => $this->selectedDifficultyId
        ]);

        session()->flash('message', 'The difficulty level is successfully updated.');
    }

    /**
     * Renders the difficulty adjustment element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.override-difficulty');
    }
}

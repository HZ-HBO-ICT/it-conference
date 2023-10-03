<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class EditPresentationModal extends Component
{
    public $presentation;

    public $name = '';

    public $description = '';

    public $type = '';

    public $max_participants = '';

    public $difficulty_id = 0;

    protected $rules = [
        'name' => 'required',
        'max_participants' => 'required|numeric',
        'description' => 'required',
        'type' => 'required|in:workshop,lecture',
        'difficulty_id' => 'required|numeric',
    ];

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->name = $this->presentation->name;
        $this->description = $this->presentation->description;
        $this->type = $this->presentation->type;
        $this->max_participants = $this->presentation->max_participants;
        $this->difficulty_id = $this->presentation->difficulty_id;
    }

    /**
     * Saves presentation data and redirects the user.
     * @return Redirector
     */
    public function save(): Redirector
    {
        if (!$this->presentation->speakerCanEdit) {
            return redirect(route('presentations.show', $this->presentation))
                ->with('status', 'Presentation cannot be updated.');
        }

        $this->validate();

        $this->presentation->name = $this->name;
        $this->presentation->description = $this->description;
        $this->presentation->type = $this->type;
        $this->presentation->max_participants = $this->max_participants;
        $this->presentation->difficulty_id = $this->difficulty_id;

        $this->presentation->save();

        return redirect(route('presentations.show', $this->presentation))
            ->with('status', 'Presentation successfully updated.');
    }

    /**
     * Displays the edit-presentation element.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.edit-presentation-modal');
    }
}

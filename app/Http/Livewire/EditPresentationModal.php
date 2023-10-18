<?php

namespace App\Http\Livewire;

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
        'max_participants' => 'required|numeric|min:1',
        'description' => 'required',
        'type' => 'required|in:workshop,lecture',
        'difficulty_id' => 'required|numeric',
    ];

    public function mount()
    {
        $this->name = $this->presentation->name;
        $this->description = $this->presentation->description;
        $this->type = $this->presentation->type;
        $this->max_participants = $this->presentation->max_participants;
        $this->difficulty_id = $this->presentation->difficulty_id;
    }

    public function save()
    {
        if (!$this->presentation->speakerCanEdit)
            return redirect(route('presentations.show', $this->presentation))
                ->with('status', 'Presentation cannot be updated.');

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


    public function render()
    {
        return view('livewire.edit-presentation-modal');
    }
}

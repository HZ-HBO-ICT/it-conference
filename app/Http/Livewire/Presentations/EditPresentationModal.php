<?php

namespace App\Http\Livewire\Presentations;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditPresentationModal extends Component
{
    use AuthorizesRequests;

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
        $this->authorize('update', $this->presentation);

        $this->validate();

        $this->presentation->name = $this->name;
        $this->presentation->description = $this->description;
        $this->presentation->type = $this->type;
        $this->presentation->max_participants = $this->max_participants;
        $this->presentation->difficulty_id = $this->difficulty_id;

        $this->presentation->save();

        if (Auth::user()->id == $this->presentation->mainSpeaker()->user->id) {
            return redirect(route('presentations.show', $this->presentation))
                ->with('status', 'Presentation successfully updated.');
        } else {
            return redirect(route('moderator.presentations.show', $this->presentation))
                ->with('status', 'Presentation successfully updated.');
        }
    }


    public function render()
    {
        return view('presentations.edit-presentation-modal');
    }
}

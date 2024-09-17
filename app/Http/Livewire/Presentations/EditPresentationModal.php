<?php

namespace App\Http\Livewire\Presentations;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
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
        'max_participants' => 'required|numeric|min:1',
        'description' => 'required',
        'type' => 'required|in:workshop,lecture',
        'difficulty_id' => 'required|numeric',
    ];

    /**
     * Triggered when the initializing the component
     * @return void
     */
    public function mount()
    {
        $this->name = $this->presentation->name;
        $this->description = $this->presentation->description;
        $this->type = $this->presentation->type;
        $this->max_participants = $this->presentation->max_participants;
        $this->difficulty_id = $this->presentation->difficulty_id;
    }

    /**
     * Saves the changes made on the presentation
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('presentations.edit-presentation-modal');
    }
}

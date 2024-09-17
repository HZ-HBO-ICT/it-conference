<?php

namespace App\Livewire\Schedule;

use App\Livewire\Forms\DefaultPresentationForm;
use App\Models\DefaultPresentation;
use App\Models\Room;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditDefaultPresentationModal extends ModalComponent
{
    public $type;
    public $rooms;
    public DefaultPresentationForm $form;

    /**
     * Initializes the component
     * @param $type
     * @return void
     */
    public function mount($type)
    {
        $this->authorize('edit-schedule');

        $this->type = $type;
        $this->rooms = Room::all();
        $this->form->setType($this->type);

        $presentation = DefaultPresentation::closing();
        if ($type == 'opening') {
            $presentation = DefaultPresentation::opening();
        }

        $this->form->setDetails($presentation);
    }

    /**
     * Saves the changes of the presentation
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function update()
    {
        $this->form->update();

        return redirect(route('moderator.schedule.index'))
            ->with('status', ucfirst($this->type) . ' is successfully updated.');
    }

    /**
     * Renders the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.schedule.edit-default-presentation-modal');
    }
}

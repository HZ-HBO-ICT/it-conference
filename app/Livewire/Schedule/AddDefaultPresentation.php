<?php

namespace App\Livewire\Schedule;

use App\Livewire\Forms\DefaultPresentationForm;
use App\Models\DefaultPresentation;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AddDefaultPresentation extends ModalComponent
{
    public $type;
    public $rooms;
    public DefaultPresentationForm $form;

    /**
     * Initializes the component
     *
     * @param $type
     * @return void
     */
    public function mount($type)
    {
        $this->type = $type;
        $this->rooms = Room::all();
        $this->form->setType($this->type);
    }

    /**
     * Saves the data from the form
     *
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector|void
     */
    public function save()
    {
        $this->form->save();

        if ($this->form->isEntityCreated()) {
            if (DefaultPresentation::opening() && DefaultPresentation::closing()) {
                Timeslot::generateTimeslots();
            }

            return redirect(route('moderator.schedule.index'))
                ->with('status', ucfirst($this->type) . ' is successfully added.');
        }
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.schedule.add-default-presentation');
    }
}

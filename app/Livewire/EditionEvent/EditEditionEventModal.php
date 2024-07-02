<?php

namespace App\Livewire\EditionEvent;

use App\Livewire\Forms\EditionEventForm;
use App\Models\Edition;
use App\Models\EditionEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class EditEditionEventModal extends ModalComponent
{
    public Edition $edition;
    public EditionEvent $editionEvent;
    public EditionEventForm $form;

    /**
     * Initializes the component
     * @param Edition $edition
     * @param EditionEvent $editionEvent
     * @return void
     */
    public function mount(Edition $edition, EditionEvent $editionEvent): void
    {
        $this->edition = $edition;
        $this->editionEvent = $editionEvent;
        $this->form->setEditionEvent($editionEvent);
    }

    /**
     * Saves the updates made on the form
     */
    public function save()
    {
        if (Auth::user()->cannot('update', Edition::class)) {
            abort(403);
        }

        $this->validate();

        $this->form->update();

        return redirect(route('moderator.events.index', $this->edition))
            ->with('status', 'Event successfully updated.');
    }

    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.edition-event.edit-edition-event-modal');
    }
}

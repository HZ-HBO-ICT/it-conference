<?php

namespace App\Livewire\Edition;

use App\Livewire\Forms\EditionForm;
use App\Models\Edition;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class EditEditionModal extends ModalComponent
{
    public Edition $edition;
    public EditionForm $form;

    /**
     * Initializes the component
     * @param Edition $edition
     * @return void
     */
    public function mount(Edition $edition): void
    {
        $this->edition = $edition;
        $this->form->setEdition($edition);
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

        return redirect(route('moderator.editions.show', $this->edition))
            ->with('status', 'Edition successfully updated.');
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
        return view('livewire.edition.edit-edition-modal');
    }
}

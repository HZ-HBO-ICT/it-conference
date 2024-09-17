<?php

namespace App\Livewire\Edition;

use App\Livewire\Forms\KeynoteForm;
use App\Models\Edition;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddKeynoteModal extends ModalComponent
{
    use WithFileUploads;

    public Edition $edition;
    public KeynoteForm $form;

    /**
     * Initializes the component
     *
     * @param Edition $edition
     * @return void
     */
    public function mount(Edition $edition): void
    {
        $this->edition = $edition;
        $this->form->setKeynote($edition);
    }

    /**
     * Saves the updates made on the form
     */
    public function save()
    {
        if (Auth::user()->cannot('update', Edition::class)) {
            abort(403);
        }

        if ($this->edition->keynote_photo_path && $this->edition->keynote_photo_path == $this->form->keynote_photo_path) {
            $this->validate([
                'form.keynote_name' => ['required', 'string', 'min:3', 'max:255'],
                'form.keynote_description' => ['required', 'string', 'min:3', 'max:700'],
            ]);
        } else {
            $this->validate();
        }

        $this->form->update();

        return redirect(route('moderator.editions.show', $this->edition))
            ->with('status', 'Keynote speaker successfully updated.');
    }

    /**
     * Sets the maximum width of the modal according to docs
     *
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render() : View
    {
        return view('livewire.edition.add-keynote-modal');
    }
}

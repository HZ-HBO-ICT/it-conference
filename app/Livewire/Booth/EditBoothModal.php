<?php

namespace App\Livewire\Booth;

use App\Livewire\Forms\BoothForm;
use App\Models\Booth;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class EditBoothModal extends ModalComponent
{
    public Booth $booth;
    public BoothForm $form;

    /**
     * Initializes the component
     * @param Booth $booth
     * @return void
     */
    public function mount(Booth $booth)
    {
        $this->booth = $booth;
        $this->form->setBooth($booth);
    }

    /**
     * Saves the updates made on the form
     */
    public function save()
    {
        $this->validate();

        $this->form->update();

        return redirect(route('moderator.booths.show', $this->booth))
            ->with('status', 'Booth successfully updated.');
    }

    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.booth.edit-booth-modal');
    }
}

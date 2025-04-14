<?php

namespace App\Livewire\PresentationType;

use App\Models\PresentationType;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public PresentationType $presentationType;

    /**
     * Mounts the modal
     * @param int $presentationTypeId
     * @return void
     */
    public function mount(int $presentationTypeId) : void
    {
        $this->presentationType = PresentationType::find($presentationTypeId);
    }

    public function delete(): void {
        $this->authorize('delete', $this->presentationType);

        $this->presentationType->delete();

        session()->flash('flash.banner', "Presentation type {$this->presentationType->name} was successfully deleted.");
        $this->redirect(route('moderator.editions.show', $this->presentationType->edition));
    }

    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.presentation-type.delete-modal');
    }
}

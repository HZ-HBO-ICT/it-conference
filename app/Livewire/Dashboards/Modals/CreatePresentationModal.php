<?php

namespace App\Livewire\Dashboards\Modals;

use App\Livewire\Forms\PresentationForm;
use App\Models\Difficulty;
use App\Models\Edition;
use App\Models\User;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class CreatePresentationModal extends ModalComponent
{
    use WithFileUploads;

    public PresentationForm $form;
    public User $user;
    public $file;
    public $presentationTypes;
    public $difficulties;

    /**
     * Initializes the component
     * @param User $user
     * @return void
     */
    public function mount(User $user) : void
    {
        $this->user = $user;
        $this->presentationTypes = optional(Edition::current())->presentationTypes;
        $this->difficulties = Difficulty::all();
    }

    /**
     * Creates a new presentation
     * @return void
     */
    public function create() : void {
        $this->validate();
        $this->form->create($this->user);
    }

    /**
     * Sets the maximum width of the modal according to docs
     * @return string
     */
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.modals.create-presentation-modal');
    }
}

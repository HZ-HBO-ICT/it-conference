<?php

namespace App\Livewire\PresentationType;

use App\Models\Edition;
use App\Models\PresentationType;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportRedirects\Redirector;
use LivewireUI\Modal\ModalComponent;

class CreateEditModal extends ModalComponent
{
    public PresentationType $presentationType;

    public ?int $presentationTypeId;

    public int $editionId;

    #[Validate('required|min:3|max:255')]
    public string $name;

    #[Validate('required|min:3|max:255')]
    public string $description;

    #[Validate('required|min:10|max:720|integer')]
    public int $duration;

    /**
     * Mounts the modal
     * @param int $editionId
     * @param int|null $presentationTypeId
     * @return void
     */
    public function mount(int $editionId, ?int $presentationTypeId = null) : void
    {
        if (!is_null($presentationTypeId)) {
            $this->presentationTypeId = $presentationTypeId;
            $presentationType = PresentationType::find($presentationTypeId);
            if ($presentationType) {
                $this->presentationType = $presentationType;
                $this->name = $this->presentationType->name;
                $this->description = $this->presentationType->description;
                $this->duration = $this->presentationType->duration;
            }
        }

        $this->editionId = $editionId;
    }

    /**
     * Validates the data and creates new presentation type
     * @return void
     * @throws AuthorizationException
     */
    public function store(): void
    {
        $this->authorize('create', PresentationType::class);

        $validated = $this->validate();

        PresentationType::create(array_merge($validated, ['edition_id' => $this->editionId]));

        session()->flash('flash.banner', "Presentation type {$this->name} successfully created.");
        $this->redirect(route('moderator.editions.show', $this->presentationType->edition));
    }

    /**
     * Validates the data and updates the presentation type
     * @return void
     * @throws AuthorizationException
     */
    public function update(): void
    {
        $this->authorize('update', $this->presentationType);

        $validated = $this->validate();

        $this->presentationType->update($validated);

        session()->flash('flash.banner', "Presentation type {$this->presentationType->name} successfully updated.");
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
        return view('livewire.presentation-type.create-edit-modal');
    }
}

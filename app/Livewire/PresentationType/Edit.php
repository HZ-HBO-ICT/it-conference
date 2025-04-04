<?php

namespace App\Livewire\PresentationType;

use App\Models\PresentationType;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public PresentationType $presentationType;

    #[Validate('required|min:3|max:255')]
    public string $name;

    #[Validate('required|min:3|max:255')]
    public string $description;

    #[Validate('required|min:10|max:720|integer')]
    public int $duration;

    public function mount($presentationTypeId) : void
    {
        $this->presentationType = PresentationType::find($presentationTypeId);
        $this->name = $this->presentationType->name;
        $this->description = $this->presentationType->description;
        $this->duration = $this->presentationType->duration;
    }

    /**
     * @return RedirectResponse
     */
    public function save(): Redirector
    {
        $validated = $this->validate();

        $this->presentationType->update($validated);

        return redirect(route('moderator.editions.show', $this->presentationType->edition))
            ->with('flash.banner', "Presentation type {$this->presentationType->name} successfully updated.");
    }

    public function render()
    {
        return view('livewire.presentation-type.edit');
    }
}

<?php

namespace App\Livewire\Forms;

use App\Models\Company;
use App\Models\Presentation;
use App\Models\PresentationType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PresentationForm extends Form
{
    public Presentation $presentation;

    #[Validate('required|string|max:255|min:1')]
    public string $name;

    #[Validate('required|string|max:300|min:1')]
    public string $description;

    #[Validate(['required', 'numeric', 'exists:presentation_types,id'])]
    public int $presentation_type_id;

    #[Validate(['required', 'numeric', 'min:1', 'max:999'])]
    public int $max_participants;

    #[Validate(['required', 'numeric', 'exists:difficulties,id'])]
    public int $difficulty_id;

    /**
     * Sets the presentation details per each field
     * @param Presentation $presentation
     * @return void
     */
    public function setCompany(Presentation $presentation)
    {
        $this->presentation = $presentation;

        $this->name = $presentation->name;
        $this->description = $presentation->description;
        $this->presentation_type_id = $presentation->presentation_type_id;
        $this->max_participants = $presentation->max_participants ?? 0;
        $this->difficulty_id = $presentation->difficulty_id ?? 1;
    }

    /**
     * Updates the company details with the new data
     * @return void
     */
    public function update()
    {
        $this->validate();

        $this->presentation->update(
            $this->all()
        );
    }
}

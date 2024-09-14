<?php

namespace App\Livewire\Forms;

use App\Models\Company;
use App\Models\Presentation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PresentationForm extends Form
{
    public $presentation;

    #[Validate('required|string|max:255|min:1')]
    public $name;

    #[Validate('required|string|max:300|min:1')]
    public $description;

    #[Validate(['required', 'in:workshop,lecture'])]
    public $type;

    #[Validate(['required', 'numeric', 'min:1', 'max:999'])]
    public $max_participants;

    #[Validate(['required', 'numeric', 'exists:difficulties,id'])]
    public $difficulty_id;

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
        $this->type = $presentation->type;
        $this->max_participants = $presentation->max_participants;
        $this->difficulty_id = $presentation->difficulty_id;
    }

    /**
     * Updates the company details with the new data
     * @return void
     */
    public function update()
    {
        $this->presentation->update(
            $this->all()
        );
    }
}

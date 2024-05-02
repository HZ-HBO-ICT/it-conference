<?php

namespace App\Livewire\Forms;

use App\Models\Edition;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditionForm extends Form
{
    public $edition;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $state;

    #[Validate(['required', 'date'])]
    public $start_at;

    #[Validate(['required', 'date'])]
    public $end_at;

    /**
     * Sets the edition details per each field
     * @param Edition $edition
     * @return void
     */
    public function setEdition(Edition $edition)
    {
        $this->edition = $edition;

        $this->name = $edition->name;
        $this->state = $edition->state;
        $this->start_at = $edition->start_at ? $edition->start_at->format('Y-m-d\TH:i:s') : '';
        $this->end_at = $edition->end_at ? $edition->end_at->format('Y-m-d\TH:i:s') : '';
    }

    /**
     * Updates the edition details with the new data
     * @return void
     */
    public function update()
    {
        $this->edition->update(
            $this->all()
        );
    }
}

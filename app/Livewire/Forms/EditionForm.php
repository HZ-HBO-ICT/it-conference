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

    #[Validate(['required', 'date_format:d-m-Y H:i:s'])]
    public $start_at;

    #[Validate(['required', 'date_format:d-m-Y H:i:s'])]
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
        $this->start_at = $edition->start_at;
        $this->end_at = $edition->end_at;
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

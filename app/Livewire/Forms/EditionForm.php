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

    #[Validate(['required', 'date'])]
    public $start_at;

    #[Validate(['required', 'date'])]
    public $end_at;

    #[Validate(['required', 'numeric', 'min:1'])]
    public $lecture_duration;

    #[Validate('required', 'numeric', 'min:1')]
    public $workshop_duration;

    /**
     * Sets the edition details per each field
     * @param Edition $edition
     * @return void
     */
    public function setEdition(Edition $edition)
    {
        $this->edition = $edition;

        $this->name = $edition->name;
        $this->start_at = $edition->start_at ? $edition->start_at->format('Y-m-d\TH:i:s') : '';
        $this->end_at = $edition->end_at ? $edition->end_at->format('Y-m-d\TH:i:s') : '';
        $this->lecture_duration = $edition->lecture_duration;
        $this->workshop_duration = $edition->workshop_duration;
    }

    /**
     * Updates the edition details with the new data
     * Updates start/end date of the event that is responsible for the new state
     * @return void
     */
    public function update()
    {
        $this->edition->update(
            $this->all()
        );
    }
}

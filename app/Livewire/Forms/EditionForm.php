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
        $this->state = $edition->state;
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
        // If the state was manually changed, perform necessary changes to crucial events responsible for
        // a particular state of the edition
        if ($this->state != Edition::whereName($this->name)->first()->state) {
            if ($this->state == Edition::STATE_ANNOUNCE) {
                $this->edition->getEvent('Company registration')->syncStartDate();
            } else if ($this->state == Edition::STATE_ENROLLMENT) {
                $this->edition->getEvent('Presentation request')->syncEndDate();
            } else if ($this->state == Edition::STATE_EXECUTION) {
                $this->edition->syncStartDate();
            }
        }

        $this->edition->update(
            $this->all()
        );
    }
}

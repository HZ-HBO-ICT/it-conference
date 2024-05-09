<?php

namespace App\Livewire\Forms;

use App\Models\EditionEvent;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditionEventForm extends Form
{
    public $editionEvent;

    #[Validate(['required', 'date'])]
    public $start_at;

    #[Validate(['required', 'date'])]
    public $end_at;

    /**
     * Sets the event details per each field
     * @param EditionEvent $editionEvent
     * @return void
     */
    public function setEditionEvent(EditionEvent $editionEvent): void
    {
        $this->editionEvent = $editionEvent;

        $this->start_at = $editionEvent->start_at ? $editionEvent->start_at->format('Y-m-d') : '';
        $this->end_at = $editionEvent->end_at ? $editionEvent->end_at->format('Y-m-d') : '';
    }

    /**
     * Updates the edition details with the new data
     * @return void
     */
    public function update(): void
    {
        $this->editionEvent->update(
            $this->all()
        );
    }
}

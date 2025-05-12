<?php

namespace App\Livewire\Forms;

use App\Models\Edition;
use App\Models\EditionEvent;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditionEventForm extends Form
{
    public $edition;

    public $editionEvent;

    public $upperBoundary;

    public $lowerBoundary;

    #[Validate(['required', 'date', 'after_or_equal:today', 'before:upperBoundary'])]
    public $start_at;

    #[Validate(['required', 'date', 'after:start_at', 'before:upperBoundary'])]
    public $end_at;

    protected $messages = [
        'start_at.after' => 'The start date should be at least from today.',
        'start_at.before' => 'The start date should be earlier than the start date of edition.',
        'end_at.after' => 'The end date should be later than start date.',
        'end_at.before' => 'The end date should be be earlier than the start date of edition.',
    ];

    /**
     * Sets the event details per each field
     *
     * @param EditionEvent $editionEvent
     * @param Edition $edition
     * @return void
     */
    public function setEditionEvent(EditionEvent $editionEvent, Edition $edition): void
    {
        $this->edition = $edition;
        $this->editionEvent = $editionEvent;

        $this->start_at = $editionEvent->start_at ? $editionEvent->start_at->format('Y-m-d') : '';
        $this->end_at = $editionEvent->end_at ? $editionEvent->end_at->format('Y-m-d') : '';
        $this->upperBoundary = $this->edition->start_at;
        $this->lowerBoundary = Carbon::now()->subMonths(2);
    }

    /**
     * Updates the edition details with the new data
     *
     * @return void
     */
    public function update(): void
    {
        $this->editionEvent->update(
            $this->all()
        );
    }
}

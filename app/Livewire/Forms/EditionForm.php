<?php

namespace App\Livewire\Forms;

use App\Models\Edition;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditionForm extends Form
{
    public $edition;

    public $upperBoundary;

    public $lowerBoundary;

    #[Validate('required')]
    public $name;

    #[Validate(['required', 'date', 'after:lowerBoundary', 'before:upperBoundary'])]
    public $start_at;

    #[Validate(['required', 'date', 'after:start_at', 'before:upperBoundary'])]
    public $end_at;

    protected $messages = [
        'start_at.after' => 'The start date should be at least a month from now.',
        'start_at.before' => 'The start date should be two years from now at latest.',
        'end_at.after' => 'The end date should be later than start date.',
        'end_at.before' => 'The end date should be two years from now at latest.',
    ];

    /**
     * Sets the edition details per each field
     * @param Edition $edition
     * @return void
     */
    public function setEdition(Edition $edition)
    {
        $this->edition = $edition;

        $this->name = $edition->name;
        $this->start_at = Carbon::parse($edition->start_at)->format('Y-m-d H:i');
        $this->end_at = Carbon::parse($edition->end_at)->format('Y-m-d H:i');
        $this->upperBoundary = Carbon::now()->addYears(2);
        $this->lowerBoundary = Carbon::now()->addMonth();
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

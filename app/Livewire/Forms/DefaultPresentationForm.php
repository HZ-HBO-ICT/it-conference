<?php

namespace App\Livewire\Forms;

use App\Models\Company;
use App\Models\DefaultPresentation;
use App\Models\Presentation;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DefaultPresentationForm extends Form
{
    #[Validate('')]
    public $name;

    #[Validate('')]
    public $description;

    #[Validate(['required', 'integer', 'exists:rooms,id'])]
    public $room_id;

    #[Validate(['required', 'in:opening,closing'])]
    public $type;

    #[Validate('required')]
    public $start;

    #[Validate(['required', 'after:start'])]
    public $end;

    /**
     * Sets the type of the presentation
     * @param $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Stores the presentation
     * @return void
     */
    public function save()
    {
        $this->validate();

        if ($this->type == 'closing') {
            $startTime = Carbon::parse($this->start);
            $openingEndTime = Carbon::parse(DefaultPresentation::opening()->end);

            if ($openingEndTime->greaterThan($startTime)) {
                $this->addError('start', 'Closing presentation must start after the opening presentation ends.');
                return;
            }
        }

        if (DefaultPresentation::where('type', $this->type)->doesntExist()) {
            DefaultPresentation::create(
                $this->all()
            );
        }
    }

    /**
     * Determines whether the entity that was supposed to be created using this form
     * is actually created
     * @return bool
     */
    public function isEntityCreated()
    {
        if ($this->type == 'opening') {
            return !is_null(DefaultPresentation::opening());
        }

        if ($this->type == 'closing') {
            return !is_null(DefaultPresentation::closing());
        }

        return false;
    }

}

<?php

namespace App\Livewire\Forms;

use App\Models\Booth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BoothForm extends Form
{
    public Booth $booth;

    #[Validate(['required', 'numeric', 'min:1', 'max:10'])]
    public $width;

    #[Validate(['required', 'numeric', 'min:1', 'max:10'])]
    public $length;

    #[Validate(['nullable', 'max:255'])]
    public $additional_information;


    /**
     * Sets the booth details per each field
     * @param Booth $booth
     * @return void
     */
    public function setBooth(Booth $booth)
    {
        $this->booth = $booth;

        $this->width = $booth->width;
        $this->length = $booth->length;
        $this->additional_information = $booth->additional_information;
    }

    /**
     * Updates the booth details with the new data
     * @return void
     */
    public function update()
    {
        $this->booth->update(
            $this->all()
        );
    }
}

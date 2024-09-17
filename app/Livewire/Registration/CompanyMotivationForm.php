<?php

namespace App\Livewire\Registration;

use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyMotivationForm extends Component
{
    #[Validate(['required', 'string', 'min:3', 'max:255'])]
    public $motivation;

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.registration.company-motivation-form');
    }

    /**
     * Dispatches an event to the parent component to go back
     * @return void
     */
    public function goBack()
    {
        $this->dispatch('go-back', formName: 'CompanyMotivationInfoForm');
    }

    /**
     * Dispatches an event to the parent to go next
     * @return void
     */
    public function goNext()
    {
        $this->validate();

        $this->dispatch('go-next', formName: 'CompanyMotivationInfoForm', input: [
            'company_motivation' => $this->motivation,
        ]);
    }
}

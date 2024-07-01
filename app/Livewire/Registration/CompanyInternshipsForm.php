<?php

namespace App\Livewire\Registration;

use Illuminate\View\View;
use Livewire\Component;

class CompanyInternshipsForm extends Component
{
    public $internshipYear = [];
    public $languages = [];
    public $tracks = [];

    /**
     * Dispatches an event to the parent component to go back
     * @return void
     */
    public function goBack()
    {
        $this->dispatch('go-back', formName: 'CompanyInternshipsInfoForm');
    }

    /**
     * Dispatches an event to the parent to go next
     * @return void
     */
    public function goNext()
    {
        $this->dispatch('go-next', formName: 'CompanyInternshipsInfoForm', input: [
            'company_internship_years' => $this->internshipYear,
            'company_internship_languages' => $this->languages,
            'company_internship_tracks' => $this->tracks,
        ]);
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.registration.company-internships-form');
    }
}

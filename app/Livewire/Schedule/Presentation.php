<?php

namespace App\Livewire\Schedule;

use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Presentation extends Component
{
    public $id;
    public $presentation;
    public $height;
    public $marginTop;
    public $details;
    public $colors;

    /**
     * Initializes the component
     * @param $presentation
     * @return void
     */
    public function mount($presentation)
    {
        $this->presentation = $presentation;
        $this->id = $this->presentation->id;
        $this->height = $this->presentation->calculateHeightInREM();
        $this->marginTop = $this->presentation->calculateMarginTopInREM();
        $this->details = $this->getDetails();
        $this->colors = $this->presentation->getColors();
    }

    /**
     * Decides whether to display company name or independent speakers name
     * @return mixed
     */
    protected function getDetails()
    {
        return is_null($this->presentation->company)
            ? $this->presentation->speakers->first()->name
            : $this->presentation->company->name;
    }

    /**
     * Listens for an update event to be dispatched from the parent to refresh the component
     * @return void
     */
    #[On("update-presentation-{id}")]
    public function refresh()
    {
        $this->presentation = $this->presentation->refresh();
        $this->height = $this->presentation->calculateHeightInREM();
        $this->marginTop = $this->presentation->calculateMarginTopInREM();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.schedule.presentation');
    }
}

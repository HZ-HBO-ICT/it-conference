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
        $this->height = $this->calculateHeightInREM();
        $this->marginTop = $this->calculateMarginTopInREM();
        $this->details = $this->getDetails();
        $this->colors = $this->getColors();
    }

    /**
     * Calculates the height of the element in REM based on it's duration
     * @return float
     */
    protected function calculateHeightInREM()
    {
        return $this->presentation->presentationType->duration * (14 / 30) * 0.25;
    }

    /**
     * Calculates the margin top of the element in REM based on how later
     * the presentation starts in comparison to the beginning of the timeslot
     * @return float
     */
    protected function calculateMarginTopInREM()
    {
        $presentationStart = Carbon::parse($this->presentation->start);
        $timeslotStart = Carbon::parse($this->presentation->timeslot->start);

        $diff = $timeslotStart->copy()->diffInMinutes($presentationStart);

        return $diff * (14 / 30) * 0.25;
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
     * Decides in what color to color the presentation based on the presentation type
     * @return string
     */
    protected function getColors()
    {
        return "bg-{$this->presentation->presentationType->colour}-300";
    }

    /**
     * Listens for an update event to be dispatched from the parent to refresh the component
     * @return void
     */
    #[On("update-presentation-{id}")]
    public function refresh()
    {
        $this->presentation = $this->presentation->refresh();
        $this->height = $this->calculateHeightInREM();
        $this->marginTop = $this->calculateMarginTopInREM();
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

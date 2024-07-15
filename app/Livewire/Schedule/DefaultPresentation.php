<?php

namespace App\Livewire\Schedule;

use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class DefaultPresentation extends Component
{
    public $height;
    public $presentation;

    /**
     * Initializes the component
     *
     * @param $type
     * @return void
     */
    public function mount($type)
    {
        $this->presentation = \App\Models\DefaultPresentation::opening();
        if ($type == 'closing') {
            $this->presentation = \App\Models\DefaultPresentation::closing();
        }

        $this->height = $this->calculateHeightInREM();
    }

    /**
     * Calculates the height of the element in REM based on it's duration
     *
     * @return float
     */
    protected function calculateHeightInREM()
    {
        $diffInMinutes = Carbon::parse($this->presentation->start)
            ->diffInMinutes(Carbon::parse($this->presentation->end));
        return $diffInMinutes * (14 / 30) * 0.25;
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render() : View
    {
        return view('livewire.schedule.default-presentation');
    }
}

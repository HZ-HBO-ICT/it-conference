<?php

namespace App\View\Components\Schedule;

use App\Models\DefaultPresentation;
use App\Models\Edition;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgressBar extends Component
{
    public $openingColor;
    public $openingBackgroundColor;
    public $openingBorderColor;
    public $closingColor;
    public $closingBackgroundColor;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if (DefaultPresentation::closing()) {
            $this->closingColor = 'text-gray-800 dark:text-apricot-peach-400';
            $this->closingBackgroundColor = 'bg-apricot-peach-400';
        } else {
            $this->closingColor = 'text-gray-800 dark:text-gray-400';
            $this->closingBackgroundColor = 'bg-gray-300';
        }

        if (DefaultPresentation::opening()) {
            $this->openingColor = 'text-gray-800 dark:text-apricot-peach-400';
            $this->openingBackgroundColor = 'bg-apricot-peach-400';
            $this->openingBorderColor = 'border-apricot-peach-400';
            $this->closingColor = 'text-gray-800 dark:text-crew-300';
            $this->closingBackgroundColor = 'bg-crew-300';
        } else {
            $this->openingColor = 'text-gray-800 dark:text-crew-300';
            $this->openingBackgroundColor = 'bg-crew-300';
            $this->openingBorderColor = 'border-gray-300';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schedule.progress-bar');
    }
}

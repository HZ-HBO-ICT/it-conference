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
            $this->closingColor = 'text-gray-200';
            $this->closingBackgroundColor = 'bg-gray-300';
        }

        if (DefaultPresentation::opening()) {
            $this->openingColor = 'text-gray-200';
            $this->openingBackgroundColor = 'bg-waitt-cyan-400';
            $this->openingBorderColor = 'border-waitt-pink-500';
            $this->closingColor = 'text-gray-200';
            $this->closingBackgroundColor = 'bg-waitt-pink-500';
        } else {
            $this->openingColor = 'text-gray-200';
            $this->openingBackgroundColor = 'bg-waitt-pink-500';
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

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PresentationDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $presentation,
        public $presentationName,
        public $presentationDescription,
        public $filename,
        public $presentationType,
        public $presentationMaxParticipants,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.presentation-details');
    }
}

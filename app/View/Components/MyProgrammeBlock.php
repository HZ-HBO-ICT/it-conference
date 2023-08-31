<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MyProgrammeBlock extends Component
{
    public $bgColor;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $presentation
    )
    {
        $this->bgColor = 'bg-indigo-900';

        if ($this->presentation->maxParticipants() <= $this->presentation->participants->count()) {
            $this->bgColor = 'bg-gray-600';
        } else {

            if (Auth::user()) {
                if (Auth::user()->presentations->contains($this->presentation)) {
                    $this->bgColor = 'bg-blue-800';
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.my-programme-block');
    }
}

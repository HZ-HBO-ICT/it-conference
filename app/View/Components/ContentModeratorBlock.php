<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModeratorBlock extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $count,
        public string $icon,
        public $routeName
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-moderator-block');
    }
}

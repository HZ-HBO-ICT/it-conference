<?php

namespace App\View\Components\Dashboards\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Crew extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $count,
        public string $route,
        public string $icon,
        public string $roleColour,
        public string $param = ''
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.blocks.crew');
    }
}

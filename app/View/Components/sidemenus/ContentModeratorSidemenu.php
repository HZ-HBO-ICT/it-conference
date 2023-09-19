<?php

namespace App\View\Components\sidemenus;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModeratorSidemenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidemenus.content-moderator-sidemenu');
    }
}

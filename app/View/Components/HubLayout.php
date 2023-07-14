<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

class HubLayout extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('layouts.myhub');
    }
}

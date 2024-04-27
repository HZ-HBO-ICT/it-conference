<?php

namespace App\View\Components;

use App\Models\Presentation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModeratorDashboard extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-moderator-dashboard');
    }
}

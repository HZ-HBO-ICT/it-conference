<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\View\Component;

class HubLayout extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        if (Auth::user()->hasRole('content moderator')) {
            return view('layouts.content-moderator');
        }
        return view('layouts.myhub');
    }
}

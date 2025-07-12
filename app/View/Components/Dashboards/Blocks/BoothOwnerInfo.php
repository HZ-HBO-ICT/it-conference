<?php

namespace App\View\Components\Dashboards\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class BoothOwnerInfo extends Component
{
    public $boothButtons = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if (!Auth::user()->company->booth) {
            $this->boothButtons['Request a booth'] = false;
        } else {
            $this->boothButtons['Join the others at the booth'] = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.blocks.booth-owner-info');
    }
}

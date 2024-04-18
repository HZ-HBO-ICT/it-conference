<?php

namespace App\View\Components\Dashboards\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Company extends Component
{
    public string $status;
    public string $accentColor;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $icon,
    ) {
        $company = Auth::user()->company;
        $this->status = '';

        if ($label === 'Company status') {
            $this->status = $company->status;
        } elseif ($label === 'Booth status') {
            $this->status = $company->boothStatus;
        } elseif ($label === 'Sponsorship status') {
            $this->status = $company->sponsorshipStatus;
        }

        $this->accentColor = $this->status === 'Approved' ?
            'purple' :
            ($this->status === 'Awaiting approval' ? 'yellow' : 'gray');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.blocks.company');
    }
}

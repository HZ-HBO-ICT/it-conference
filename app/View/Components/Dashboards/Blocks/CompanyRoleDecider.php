<?php

namespace App\View\Components\Dashboards\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CompanyRoleDecider extends Component
{
    public $speakerButtons = [];
    public $boothButtons = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $company = Auth::user()->company;

        if ($company->hasPresentationsLeft) {
            $this->speakerButtons['Request a presentation'] = 'presentations.create';
        }
        if ($company->presentations) {
            foreach ($company->presentations as $presentation) {
                $this->speakerButtons["Join '{$presentation->name}' as a co-speaker"] =
                    ['presentations.show', $presentation];
            }
        }

        if (!$company->booth) {
            $this->boothButtons['Request a booth'] = 'company.requests';
        } else {
            $this->boothButtons['Join the others at the booth'] = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.blocks.company-role-decider');
    }
}

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
        $company = optional(Auth::user())->company;

        if ($company) {
            if ($company->hasPresentationsLeft) {
                $this->speakerButtons['Request a presentation'] = null;
            }
            if ($company->presentations) {
                foreach ($company->presentations as $presentation) {
                    $this->speakerButtons["Join '{$presentation->name}' as a co-speaker"] =
                        $presentation;
                }
            }

            if (!$company->booth) {
                $this->boothButtons['Request a booth'] = false;
            } else {
                $this->boothButtons['Join the others at the booth'] = true;
            }
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

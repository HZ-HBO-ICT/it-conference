<?php

namespace App\View\Components\Dashboards\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SpeakerInfo extends Component
{
    public $speakerButtons = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $company = Auth::user()->company;

        if ($company->hasPresentationsLeft) {
            $this->speakerButtons['Request a presentation'] = null;
        }
        if ($company->presentations) {
            foreach ($company->presentations as $presentation) {
                $this->speakerButtons["Join '{$presentation->name}' as a co-speaker"] =
                    $presentation;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.blocks.speaker-info');
    }
}

<?php

namespace App\View\Components\Dashboards;

use App\Enums\ApprovalStatus;
use App\Models\Presentation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Crew extends Component
{
    public $numberOfPresentationRequests;
    public $numberOfUnscheduledPresentations;
    public $numberOfScheduledPresentations;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->numberOfPresentationRequests = Presentation::hasStatus(ApprovalStatus::AWAITING_APPROVAL)->count();

        $this->numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();

        $this->numberOfScheduledPresentations = Presentation::count() - $this->numberOfUnscheduledPresentations;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboards.crew');
    }
}

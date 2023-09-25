<?php

namespace App\View\Components;

use App\Models\Presentation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModeratorDashboard extends Component
{
    public $numberOfPresentationRequests;
    public $numberOfUnscheduledPresentations;
    public $numberOfScheduledPresentations;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->numberOfPresentationRequests = Presentation::whereHas('speakers', function ($query) {
            $query->where('is_approved', false);
        })->count();

        $this->numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();

        $this->numberOfScheduledPresentations = Presentation::all()->count() - $this->numberOfUnscheduledPresentations;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-moderator-dashboard');
    }
}

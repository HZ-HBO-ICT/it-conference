<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModPresentationRequestDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $speakerName,
        public $speakerEmail,
        public $affiliation,
        public $presentationTitle,
        public $presentationDescription,
        public $presentationType,
        public $maxParticipants,
        public $createdAt,
        public $formActionApprove,
        public $formActionReject,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-moderator.content-mod-presentation-request-details');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModSponsorRequestDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $companyName,
        public $sponsorTier,
        public $companyRepName,
        public $companyRepEmail,
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
        return view('components.content-moderator.content-mod-sponsor-request-details');
    }
}

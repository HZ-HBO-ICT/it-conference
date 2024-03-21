<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModCompanyRequestDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $companyName,
        public $createdAt,
        public $description,
        public $address,
        public $website,
        public $teamOwnerName,
        public $teamOwnerEmail,
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
        return view('components.content-mod-company-request-details');
    }
}

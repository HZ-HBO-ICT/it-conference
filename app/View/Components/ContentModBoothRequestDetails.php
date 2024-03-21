<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentModBoothRequestDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $boothName,
        public $companyName,
        public $isSponsor,
        public $additionalInfo,
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
        return view('components.content-mod-booth-request-details');
    }
}

<?php

namespace App\Livewire\Company;

use App\Enums\ApprovalStatus;
use App\Models\Sponsorship;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class SponsorshipRequest extends Component
{
    public $company;
    public $tiers;
    public $chosenTierName;
    public $requestSent;

    /**
     * Triggered when initializing a component
     * @param $company
     * @return void
     */
    public function mount($company)
    {
        $this->company = $company;
        $this->tiers = Sponsorship::all();
        foreach ($this->tiers as $tier) {
            if ($tier->leftSpots() > 0) {
                $this->chosenTierName = $tier->name;
                break;
            }
        }

        $this->requestSent = (bool)$this->company->sponsorship;
    }

    /**
     * Render the component
     * @return View
     */
    public function render(): View
    {
        return view('livewire.company.sponsorship-request');
    }

    /**
     * Sends a request for a sponsorship
     * @return void
     */
    public function requestSponsorship()
    {
        if (!$this->company->sponsorship) {
            $chosenTier = $this->tiers->firstWhere('name', $this->chosenTierName);
            $this->company->sponsorship_id = $chosenTier->id;
            $this->company->sponsorship_approval_status = ApprovalStatus::AWAITING_APPROVAL->value;
            $this->company->save();
            $this->company->refresh();
            $this->requestSent = true;
            session()->flash('success', 'The request has been sent successfully.');
        }
    }
}

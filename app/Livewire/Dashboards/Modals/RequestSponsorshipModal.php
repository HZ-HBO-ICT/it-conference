<?php

namespace App\Livewire\Dashboards\Modals;

use App\Enums\ApprovalStatus;
use App\Models\Company;
use App\Models\Sponsorship;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class RequestSponsorshipModal extends ModalComponent
{
    public Company $company;
    public $tiers;
    public $chosenTierName;
    public $requestSent;

    /**
     * Initialize the component
     * @param Company $company
     * @return void
     */
    public function mount(Company $company) : void {
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
            Toaster::success('Sponsorship request sent successfully.');
        }
    }

    /**
     * Close the modal
     * @return void
     */
    public function cancel() : void
    {
        $this->closeModal();
    }

    /**
     * Renders the component
     * @return View
     */
    public function render() : View
    {
        return view('livewire.dashboards.modals.request-sponsorship-modal');
    }
}

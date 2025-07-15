<?php

namespace App\Livewire\Dashboards\Modals;

use App\Enums\ApprovalStatus;
use App\Models\Company;
use App\Models\Presentation;
use App\Models\Sponsorship;
use http\Exception\RuntimeException;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;

class RequestSponsorshipModal extends ModalComponent
{
    public Company $company;
    /** @var Collection<int, Sponsorship> */
    public $tiers;
    public string $chosenTierName;
    public bool $requestSent;

    /**
     * Initialize the component
     * @param Company $company
     * @return void
     */
    public function mount(Company $company) : void
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
     * Sends a request for a sponsorship
     * @return void
     */
    public function requestSponsorship()
    {
        $this->authorize('createRequest', Sponsorship::class);

        if (!$this->company->sponsorship) {
            $chosenTier = $this->tiers->firstWhere('name', $this->chosenTierName);

            if (!$chosenTier) {
                throw new RuntimeException('There is no such tier');
            }

            $this->company->sponsorship_id = $chosenTier->id;
            $this->company->sponsorship_approval_status = ApprovalStatus::AWAITING_APPROVAL->value;
            $this->company->save();
            $this->company->refresh();
            $this->requestSent = true;
            $this->dispatch('updated-dashboard');
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

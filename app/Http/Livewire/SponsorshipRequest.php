<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class SponsorshipRequest extends Component
{
    public $team;
    public $tiers;
    public $chosenTierName;
    public $requestSent;

    /**
     * @param $team
     * @param $tiers
     * @return void
     */
    public function mount($team, $tiers): void
    {
        $this->team = $team;
        $this->tiers = $tiers;
        foreach ($tiers as $tier) {
            if ($tier->leftSpots() > 0) {
                $this->chosenTierName = $tier->name;
                break;
            }
        }

        $this->requestSent = (bool)$this->team->sponsorTier;
    }

    /**
     * Returns a view of the sponsorship request.
     * @return View
     */
    public function render(): View
    {
        return view('livewire.sponsorship-request');
    }

    /**
     * Function that allows someone to request a sponsorship.
     * @return void
     */
    public function requestSponsorship(): void
    {
        if (!$this->team->sponsorTier) {
            $chosenTier = $this->tiers->firstWhere('name', $this->chosenTierName);
            $this->team->sponsor_tier_id = $chosenTier->id;
            $this->team->is_sponsor_approved = 0;
            $this->team->save();
            $this->team->refresh();
            $this->requestSent = true;
            session()->flash('success', 'The request has been sent successfully.');
        }
    }
}

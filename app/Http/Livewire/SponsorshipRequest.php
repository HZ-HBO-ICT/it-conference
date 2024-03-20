<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Livewire\Component;

class SponsorshipRequest extends Component
{
    public $team;
    public $tiers;
    public $chosenTierName;
    public $requestSent;

    /**
     * Triggered when initializing a component
     * @param $team
     * @param $tiers
     * @return void
     */
    public function mount($team, $tiers)
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
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('livewire.sponsorship-request');
    }

    /**
     * Sends a request for a sponsorship
     * @return void
     */
    public function requestSponsorship()
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

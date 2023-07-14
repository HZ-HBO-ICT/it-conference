<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SponsorshipRequest extends Component
{
    public $team;
    public $tiers;
    public $chosenTierName;
    public $requestSent;

    public function mount($team, $tiers)
    {
        $this->team = $team;
        $this->tiers = $tiers;
        $this->chosenTierName = 'golden';

        $this->requestSent = (bool)$this->team->sponsorTier;
    }

    public function render()
    {
        return view('livewire.sponsorship-request');
    }

    public function requestSponsorship()
    {
        if(!$this->team->sponsorTier)
        {
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

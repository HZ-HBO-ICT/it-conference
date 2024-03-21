<?php

namespace App\Http\Livewire\Sponsorships;

use App\Models\SponsorTier;
use App\Models\Team;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class CreateSponsorshipForm extends Component
{
    public $teamId;
    public $tierId;


    public $teams;
    public $tiers;

    /**
     * Triggered on the initializing of the component
     * @return void
     */
    public function mount()
    {
        $this->teams = Team::where('sponsor_tier_id', null)->get();
        $this->tiers = SponsorTier::all()->filter(function ($tier) {
            return $tier->areMoreSponsorsAllowed();
        });

        $this->teamId = $this->teams->first()->id;
        $this->tierId = $this->tiers->first()->id;
    }

    /**
     * Add company as a sponsor
     * @return RedirectResponse
     */
    public function addSponsorship()
    {
        $team = Team::find($this->teamId);
        $team->sponsor_tier_id = $this->tierId;
        $team->is_sponsor_approved = 1;
        $team->save();

        return redirect(route('moderator.sponsors.index'));
    }

    /**
     * Render the component
     * @return Factory|Application|\Illuminate\Contracts\View\View|ApplicationContract
     */
    public function render()
    {
        return view('moderator.sponsors.create-sponsorship-form');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SponsorTier;
use App\Models\Team;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Lists all sponsors by tier.
     * @return View
     */
    public function index()
    {
        $goldSponsor = SponsorTier::where('name', 'golden')->first()->teams->first();
        $allSponsors = Team::where('is_sponsor_approved', 1)
            ->orderBy('sponsor_tier_id', 'asc')
            ->get();

        return view('welcome', compact(['goldSponsor', 'allSponsors']));
    }
}

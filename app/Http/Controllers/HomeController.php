<?php

namespace App\Http\Controllers;

use App\Models\SponsorTier;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $goldSponsor = SponsorTier::where('name', 'golden')->first()->teams->first();
        $allSponsors = Team::where('is_sponsor_approved', 1)->get();

        return view('welcome', compact(['goldSponsor', 'allSponsors']));
    }
}

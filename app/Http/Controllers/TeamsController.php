<?php

namespace App\Http\Controllers;

use App\Models\SponsorTier;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::where('is_approved', 1)->get();

        return view('companies', compact('teams'));
    }

    public function getSponsors() {
        $goldSponsor = SponsorTier::where('name', 'golden')->first()->teams->first();
        $allSponsors = Team::where('is_sponsor_approved', 1)->get();

        return view('welcome', compact(['goldSponsor', 'allSponsors']));
    }
}

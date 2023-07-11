<?php

namespace App\Http\Controllers;

use App\Models\SponsorTier;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamRequestsController extends Controller
{
    public function index(Team $team)
    {
        $tiers = SponsorTier::all();
        return view('teams.requests', compact('team', 'tiers'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SponsorTier;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TeamRequestsController extends Controller
{
    public function index(Team $team)
    {
        if (Gate::check('requestBoothOrSponsorship', $team)) {
            $tiers = SponsorTier::all();
            return view('teams.requests', compact('team', 'tiers'));
        }

        abort(403);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SponsorTier;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;

class TeamRequestsController extends Controller
{
    /**
     * Checks if team has requested a booth or a sponsorship, then returns the request data.
     * If user is not on a team, return 403.
     * @param Team $team Team of the user.
     * @return View
     */
    public function index(Team $team): View
    {
        if (Gate::check('requestBoothOrSponsorship', $team)) {
            $tiers = SponsorTier::all();
            return view('teams.requests', compact('team', 'tiers'));
        }

        abort(403);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SponsorTier;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class
TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = DB::table('teams')
            ->where('is_approved', 1)
            ->orderByRaw('ISNULL(sponsor_tier_id), sponsor_tier_id ASC')
            ->get();

        return view('companies', compact('teams'));
    }

    public function show(Team $team)
    {
        return view('teams.public.show', compact($team));
    }
}

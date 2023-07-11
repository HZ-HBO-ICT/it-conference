<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamRequestsController extends Controller
{
    public function index(Team $team)
    {
        return view('teams.requests', compact('team'));
    }
}

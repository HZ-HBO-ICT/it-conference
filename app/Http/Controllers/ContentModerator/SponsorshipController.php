<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\SponsorTier;
use App\Models\Team;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $teams = Team::whereNotNull('sponsor_tier_id')
            ->orderBy('is_sponsor_approved')->paginate(15);

        return view('moderator.sponsors.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Team $sponsor
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function show(Team $sponsor): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('moderator.sponsors.show', compact('sponsor'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param Team $team
     */
    public function approve(Request $request, Team $team)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        $team->handleSponsorshipApproval($isApproved);

        $template = $isApproved ? 'You approved the sponsorship of :company!'
            : 'You denied the sponsorship of :company';
        return redirect(route('moderator.sponsors.show', $team))
            ->banner(__($template, ['company' => $team->name]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SponsorTier $sponsorTier)
    {
        //
    }
}

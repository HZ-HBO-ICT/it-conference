<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View|ApplicationContract
     */
    public function index(): Factory|Application|View|ApplicationContract
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
        return view('moderator.sponsors.create');
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
     * @return Factory|Application|View|ApplicationContract
     */
    public function show(Team $sponsor): Factory|Application|View|ApplicationContract
    {
        if (!$sponsor->sponsor_tier_id) {
            abort(404);
        }

        return view('moderator.sponsors.show', compact('sponsor'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param Team $sponsor
     */
    public function approve(Request $request, Team $sponsor)
    {
        $validated = $request->validate([
            'approved' => 'required|boolean'
        ]);

        $isApproved = $validated['approved'];
        $sponsor->handleSponsorshipApproval($isApproved);

        $template = $isApproved ? 'You approved the sponsorship of :company!'
            : 'You denied the sponsorship of :company';

        if ($isApproved) {
            return redirect(route('moderator.sponsors.show', $sponsor))
                ->banner(__($template, ['company' => $sponsor->name]));
        }

        return redirect(route('moderator.sponsors.index', $sponsor))
            ->banner(__($template, ['company' => $sponsor->name]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $sponsor)
    {
        $sponsor->sponsorTier()->disassociate();
        $sponsor->is_sponsor_approved = false;
        $sponsor->save();

        $template = 'You removed the sponsorship from :company!';
        return redirect(route('moderator.sponsors.index'))
            ->banner(__($template, ['company' => $sponsor->name]));
    }
}

<?php

namespace App\Http\Controllers\ContentModerator;

use App\Http\Controllers\Controller;
use App\Models\Booth;
use App\Models\Presentation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContentModeratorController extends Controller
{
    /**
     * Gets all requests of a specific type
     * @param string $type The type of requests ('teams', 'booths', or 'sponsorships').
     * @return View
     */
    public function requests(string $type): View
    {
        if ($type == 'teams') {
            $teams = Team::where('is_approved', false)->paginate(5);
            return view('moderator.requests.teams', compact('type', 'teams'));
        } else if ($type == 'booths') {
            $booths = Booth::where('is_approved', false)->paginate(5);
            return view('moderator.requests.booths', compact('type', 'booths'));
        } else if ($type == 'sponsorships') {
            $teams = Team::where('is_sponsor_approved', false)->whereNotNull('sponsor_tier_id')->paginate(5);
            return view('moderator.requests.sponsorships', compact('type', 'teams'));
        } else if ($type == 'presentations') {
            $presentations = Presentation::whereHas('speakers', function ($query) {
                $query->where('is_approved', false);
            })->paginate(5);
            return view('moderator.requests.presentations', compact('type', 'presentations'));
        }

        abort(404);
    }

    /**
     * Gets the details for a specific request
     * @param string $type The type of requests ('teams', 'booths', or 'sponsorships').
     * @param int $id
     * @return View
     */
    public function details(string $type, int $id): View
    {
        if ($type == 'teams') {
            $team = Team::find($id);
            return view('moderator.details.team', compact('team'));
        } else if ($type == 'booths') {
            $booth = Booth::find($id);
            return view('moderator.details.booth', compact('booth'));
        } else if ($type == 'sponsorships') {
            $team = Team::find($id);
            return view('moderator.details.sponsorship', compact('team'));
        } else if ($type == 'presentations') {
            $presentation = Presentation::find($id);
            return view('moderator.details.presentation', compact('presentation'));
        }

        abort(404);
    }

    /**
     * Changes the approval status of the given team based
     * on the given boolean
     * @param Team $team
     * @param bool $isApproved
     * @return RedirectResponse
     */
    public function changeApprovalStatusOfTeam(Team $team, bool $isApproved): RedirectResponse
    {
        $team->handleTeamApproval($isApproved);

        $template = $isApproved ? 'You approved :company to join the IT Conference!!'
            : 'You refused the request of :company to join the IT conference';
        return redirect(route('moderator.requests', 'teams'))
            ->banner(__($template, ['company' => $team->name]));
    }

    /**
     * Changes the approval status of the given booth based
     * on the given boolean
     *
     * @param Booth $booth
     * @param bool $isApproved
     * @return RedirectResponse
     */
    public function changeApprovalStatusOfBooth(Booth $booth, bool $isApproved): RedirectResponse
    {
        $booth->handleApproval($isApproved);

        $template = $isApproved ? 'You approved the booth of :company!'
            : 'You denied the request of :company to have a booth';
        return redirect(route('moderator.booths.index'))
            ->banner(__($template, ['company' => $booth->team->name]));
    }

    /**
     * Changes the approval status of the given booth based
     * on the given boolean
     *
     * @param Team $team
     * @param bool $isApproved
     * @return RedirectResponse
     */
    public function changeApprovalStatusOfSponsorship(Team $team, bool $isApproved): RedirectResponse
    {
        $team->handleSponsorshipApproval($isApproved);

        $template = $isApproved ? 'You approved the sponsorship of :company!'
            : 'You denied the sponsorship of :company';
        return redirect(route('moderator.requests', 'sponsorships'))
            ->banner(__($template, ['company' => $team->name]));
    }

    /**
     * Changes the approval status of the given presentation based
     * on the given boolean
     *
     * @param Presentation $presentation
     * @param bool $isApproved
     * @return RedirectResponse
     */
    public function changeApprovalStatusOfPresentation(Presentation $presentation, bool $isApproved): RedirectResponse
    {
        $mainSpeakerName = $presentation->mainSpeaker()->user->name;
        $presentation->handleApproval($isApproved);

        $template = $isApproved ? 'You approved :name to host a presentation during the IT Conference!'
            : 'You refused the request of :name to host presentation during the IT conference';
        return redirect(route('moderator.requests', 'presentations'))
            ->banner(__($template, ['name' => $mainSpeakerName]));
    }

    /**
     * Returns the moderator general list view
     *
     * @param string $type
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function showList(string $type): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $list = [];

        if ($type === 'teams')
            $list = Team::where('is_approved', 1)->get();
        else if ($type === 'users')
            $list = User::all();
        else if ($type === 'participants')
            $list = User::role('participant')->get();
        else if ($type === 'speakers')
            $list = User::role('speaker')->get();
        else if ($type === 'booths')
            $list = Booth::where('is_approved', 1)->get();
        else if ($type === 'presentations')
            $list = Presentation::all()->filter(fn($presentation) => $presentation->isApproved && $presentation->isScheduled);

        return view('moderator.lists.general', compact('list', 'type'));
    }
}

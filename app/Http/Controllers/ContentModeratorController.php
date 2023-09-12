<?php

namespace App\Http\Controllers;

use App\Events\BoothApproved;
use App\Events\BoothDisapproved;
use App\Events\PresentationApproved;
use App\Events\PresentationDisapproved;
use App\Events\SponsorshipApproved;
use App\Events\SponsorshipDisapproved;
use App\Events\TeamApproved;
use App\Events\TeamDisapproved;
use App\Mail\BoothApprovedMailable;
use App\Mail\BoothDisapprovedMailable;
use App\Mail\CustomTeamInvitation;
use App\Mail\PresentationApprovedMailable;
use App\Mail\PresentationDisapprovedMailable;
use App\Mail\SponsorshipApprovedMailable;
use App\Mail\SponsorshipDisapprovedMailable;
use App\Mail\TeamApprovedMailable;
use App\Mail\TeamDisapprovedMailable;
use App\Models\Booth;
use App\Models\Presentation;
use App\Models\Speaker;
use App\Models\Team;
use App\Actions\Jetstream\DeleteTeam;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

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
     * Change the approval status of a request.
     * @param string $type The type of the request ('teams', 'booths', or 'sponsorships').
     * @param int $id The ID of the request.
     * @param bool $isApproved Whether the request is approved or not.
     * @return RedirectResponse|Redirector
     */
    public function changeApprovalStatus(string $type, int $id, bool $isApproved)
    {
        if ($type == 'teams') {
            return $this->changeApprovalStatusOfTeam(Team::find($id), $isApproved);
        } else if ($type == 'booths') {
            return $this->changeApprovalStatusOfBooth(Booth::findOrFail($id), $isApproved);
        } else if ($type == 'sponsorships') {
            return $this->changeApprovalStatusOfSponsorship(Team::find($id), $isApproved);
        } else if ($type == 'presentations') {
            return $this->changeApprovalStatusOfPresentation(Presentation::find($id), $isApproved);
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
        $message = '';
        if ($isApproved) {
            TeamApproved::dispatch($team);
            $message = __('You approved :company to join the IT Conference!', ['company' => $team->name]);
        } else {
            TeamDisapproved::dispatch($team);
            $message = __('You refused the request of :company to join the IT conference', ['company' => $team->name]);
        }

        return redirect(route('moderator.requests', 'teams'))->banner($message);
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
        return redirect(route('moderator.requests', 'booths'))
            ->banner(__($template, ['company' => $booth->team->name]));
    }

    /**
     * Changes the approval status of the given booth based
     * on the given boolean
     * @param Booth $booth
     * @param bool $isApproved
     * @return RedirectResponse
     */
    public function changeApprovalStatusOfSponsorship(Team $team, bool $isApproved)
    {
        $message = '';
        if ($isApproved) {
            SponsorshipApproved::dispatch($team);
            $message = __('You approved the sponsorship of :company!', ['company' => $team->name]);

        } else {
            SponsorshipDisapproved::dispatch($team);
            $message = __('You denied the sponsorship of :company', ['company' => $team->name]);
        }

        return redirect(route('moderator.requests', 'sponsorships'))->banner($message);
    }

    public function changeApprovalStatusOfPresentation(Presentation $presentation, bool $isApproved): RedirectResponse
    {
        $message = '';
        if ($isApproved) {
            PresentationApproved::dispatch($presentation);
            $message = __('You approved :name to host a presentation during the IT Conference!', ['name' => $presentation->mainSpeaker()->user->name]);

        } else {
            $message = __('You refused the request of :name to host presentation during the IT conference', ['name' => $presentation->mainSpeaker()->user->name]);
            PresentationDisapproved::dispatch($presentation);
        }

        return redirect(route('moderator.requests', 'presentations'))->banner($message);
    }

    public function overview()
    {
        $numberOfPresentationRequests = Presentation::whereHas('speakers', function ($query) {
            $query->where('is_approved', false);
        })->count();

        $numberOfUnscheduledPresentations = Presentation::all()->filter(function ($presentation) {
            return !$presentation->isScheduled && $presentation->isApproved;
        })->count();

        $numberOfScheduledPresentations = Presentation::all()->count() - $numberOfUnscheduledPresentations;

        return view('moderator.overview', compact(
            'numberOfPresentationRequests',
            'numberOfUnscheduledPresentations',
            'numberOfScheduledPresentations'
        ));
    }

    public function showList(string $type)
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

<?php

namespace App\Http\Controllers;

use App\Mail\BoothApproved;
use App\Mail\BoothDisapproved;
use App\Mail\CustomTeamInvitation;
use App\Mail\PresentationApproved;
use App\Mail\PresentationDisapproved;
use App\Mail\SponsorshipApproved;
use App\Mail\SponsorshipDisapproved;
use App\Mail\TeamApproved;
use App\Mail\TeamDisapproved;
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
            $teams = Team::where('is_approved', false)->get();
            return view('moderator.requests.teams', compact('type', 'teams'));
        } else if ($type == 'booths') {
            $booths = Booth::where('is_approved', false)->get();
            return view('moderator.requests.booths', compact('type', 'booths'));
        } else if ($type == 'sponsorships') {
            $teams = Team::where('is_sponsor_approved', false)->whereNotNull('sponsor_tier_id')->get();
            return view('moderator.requests.sponsorships', compact('type', 'teams'));
        } else if ($type == 'presentations') {
            $presentations = Presentation::whereHas('speakers', function ($query) {
                $query->where('is_approved', false);
            })->get();
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
            return $this->changeApprovalStatusOfBooth(Booth::find($id), $isApproved);
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
            $team->is_approved = true;
            $team->owner->assignRole('company representative');
            $team->save();
            Mail::to($team->owner->email)->send(new TeamApproved($team));

            $message = __('You approved :company to join the IT Conference!', ['company' => $team->name]);

        } else {
            Mail::to($team->owner->email)->send(new TeamDisapproved($team));

            $deleteTeam = new DeleteTeam();
            $deleteTeam->delete($team);

            $message = __('You refused the request of :company to join the IT conference', ['company' => $team->name]);
        }

        return redirect(route('moderator.requests', 'teams'))->banner($message);
    }

    /**
     * Changes the approval status of the given booth based
     * on the given boolean
     * @param Booth $booth
     * @param bool $isApproved
     * @return RedirectResponse
     */
    public function changeApprovalStatusOfBooth(Booth $booth, bool $isApproved): RedirectResponse
    {
        $message = '';
        if ($isApproved) {
            $booth->is_approved = true;
            $booth->save();
            Mail::to($booth->team->owner->email)->send(new BoothApproved($booth->team));

            $message = __('You approved the booth of :company!', ['company' => $booth->team->name]);

        } else {
            Mail::to($booth->team->owner->email)->send(new BoothDisapproved($booth->team));
            $booth->delete();

            $message = __('You denied the request of :company to have a booth', ['company' => $booth->team->name]);
        }

        return redirect(route('moderator.requests', 'booths'))->banner($message);
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
            $team->is_sponsor_approved = true;
            $team->save();
            Mail::to($team->owner->email)->send(new SponsorshipApproved($team));

            $message = __('You approved the sponsorship of :company!', ['company' => $team->name]);

        } else {
            Mail::to($team->owner->email)->send(new SponsorshipDisapproved($team));
            $team->is_sponsor_approved = null;
            $team->sponsor_tier_id = null;
            $team->save();

            $message = __('You denied the sponsorship of :company', ['company' => $team->name]);
        }

        return redirect(route('moderator.requests', 'sponsorships'))->banner($message);
    }

    public function changeApprovalStatusOfPresentation(Presentation $presentation, bool $isApproved): RedirectResponse
    {
        $message = '';
        if ($isApproved) {
            $user = User::find($presentation->mainSpeaker()->user->id);
            $user->speaker->is_approved = 1;
            $user->assignRole('speaker');
            $user->speaker->save();

            Mail::to($presentation->mainSpeaker()->user->email)->send(new PresentationApproved());

            $message = __('You approved :name to host a presentation during the IT Conference!', ['name' => $presentation->mainSpeaker()->user->name]);

        } else {
            $message = __('You refused the request of :name to host presentation during the IT conference', ['name' => $presentation->mainSpeaker()->user->name]);

            Mail::to($presentation->mainSpeaker()->user->email)->send(new PresentationDisapproved());
            $presentation->speakers()->delete();
            $presentation->delete();
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
}

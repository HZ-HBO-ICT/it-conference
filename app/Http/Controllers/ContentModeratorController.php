<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Actions\Jetstream\DeleteTeam;

class ContentModeratorController extends Controller
{
    public function requests(string $type)
    {
        if ($type == 'teams') {
            $teams = Team::where('is_approved', false)->get();
            return view('moderator.requests.teams', compact('type', 'teams'));
        } else if ($type == 'booths') {
            $booths = Booth::where('is_approved', false)->get();
            return view('moderator.requests.booths', compact('type', 'booths'));
        }

        abort(404);
    }

    public function details(string $type, int $id)
    {
        if ($type == 'teams') {
            $team = Team::find($id);
            return view('moderator.details.team', compact('team'));
        } else if ($type == 'booths') {
            $booth = Booth::find($id);
            return view('moderator.details.booth', compact('booth'));
        }

        abort(404);
    }

    public function changeApprovalStatus(string $type, int $id, bool $isApproved)
    {
        if ($type == 'teams') {
            return $this->changeApprovalStatusOfTeam(Team::find($id), $isApproved);
        } else if ($type == 'booths') {
            return $this->changeApprovalStatusOfBooth(Booth::find($id), $isApproved);
        }

        abort(404);
    }

    public function changeApprovalStatusOfTeam(Team $team, bool $isApproved)
    {
        $message = '';
        if ($isApproved) {
            $team->is_approved = true;
            $team->owner->assignRole('company representative');
            $team->save();

            $message = __('You approved :company to join the IT Conference!', ['company' => $team->name]);

        } else {
            $deleteTeam = new DeleteTeam();
            $deleteTeam->delete($team);

            $message = __('You refused the request of :company to join the IT conference', ['company' => $team->name]);
        }

        return redirect(route('moderator.requests', 'teams'))->banner($message);
    }

    public function changeApprovalStatusOfBooth(Booth $booth, bool $isApproved)
    {
        $message = '';
        if ($isApproved) {
            $booth->is_approved = true;
            $booth->save();

            $message = __('You approved the booth of :company!', ['company' => $booth->team->name]);

        } else {
            $booth->delete();

            $message = __('You denied the request of :company to have a booth', ['company' => $booth->team->name]);
        }

        return redirect(route('moderator.requests', 'booths'))->banner($message);
    }
}

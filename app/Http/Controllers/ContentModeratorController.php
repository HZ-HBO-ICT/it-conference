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
        }

        abort(404);
    }

    public function details(string $type, int $id)
    {
        if ($type == 'teams') {
            $team = Team::find($id);
            return view('moderator.details.team', compact('team'));
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
}

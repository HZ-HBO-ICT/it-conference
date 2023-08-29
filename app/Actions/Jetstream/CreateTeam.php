<?php

namespace App\Actions\Jetstream;

use App\Mail\CustomTeamInvitation;
use App\Mail\InviteCompany;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Events\InvitingTeamMember;
use Laravel\Jetstream\Jetstream;

class CreateTeam implements CreatesTeams
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param array<string, string> $input
     */
    public function create(User $user, array $input): Team
    {
        if (!$user->hasRole('content moderator')) {
            abort(403);
        }

        Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'website' => 'required',
            'postcode' => 'required',
            'house_number' => 'required',
            'street' => 'required',
            'city' => 'required',
            'rep_name' => 'required',
            'rep_email' => 'required'
        ])->validateWithBag('createTeam');

        $user = User::create([
            'name' => $input['rep_name'],
            'email' => $input['rep_email'],
            'password' => Hash::make(fake()->password)]);

        $user->assignRole('company representative');

        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => $input['name'],
            'postcode' => $input['postcode'],
            'house_number' => $input['house_number'],
            'street' => $input['street'],
            'city' => $input['city'],
            'website' => $input['website'],
            'description' => $input['description'],
            'personal_team' => false,
            'is_approved' => true,
        ]);

        // Reusing the default team invitation
        $invitation = $team->teamInvitations()->create([
            'email' => $user->email,
            'role' => 'company representative',
        ]);
        Mail::to($user->email)->send(new InviteCompany($invitation));

        return $team;
    }
}

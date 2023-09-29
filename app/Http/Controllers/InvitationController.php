<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Actions\Fortify\ResetUserPassword;
use App\Models\Speaker;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\TeamInvitation;

class InvitationController extends Controller
{
    use PasswordValidationRules;

    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Returns the view that the user registers through ONLY if they're using an invitation
     * @param Request $request
     * @param TeamInvitation $invitation
     * @return View
     */
    public function show(Request $request, TeamInvitation $invitation): View
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        return view('auth.registration-via-invitation', compact('invitation'));
    }

    /**
     * Creates the user and adds him as a part of the team they had been invited to
     * @param Request $request
     * @param TeamInvitation $invitation
     * @param CreatesNewUsers $creator
     * @return RedirectResponse
     */
    public function register(Request $request, TeamInvitation $invitation, CreatesNewUsers $creator): RedirectResponse
    {
        $input = $request->all();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        Validator::make($input, $rules)->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'email_verified_at' => now()->timestamp
        ]);

        event(new Registered($user));
        $this->guard->login($user);

        app(AddsTeamMembers::class)->add(
            $invitation->team->owner,
            $invitation->team,
            $invitation->email,
            $invitation->role
        );

        $invitation->delete();
        $user->switchTeam($invitation->team);

        // This checks if the team already has an approved presentation - add the speaker as supporter
        // and automatically approve. If the team doesn't have an approved presentation, but they have
        // a request, then add the speaker but don't approve it

        // New update: when the sponsor is gold this should not be executed
        // Another update: when the team is HZ it also should not be executed
        $sponsorTier = $user->currentTeam->sponsorTier;

        if ((!$sponsorTier || $sponsorTier->name !== 'golden') && !$user->currentTeam->isHz) {
            if ($user->currentTeam->presentations) {
                Speaker::create([
                    'user_id' => $user->id,
                    'presentation_id' => $user->currentTeam->presentations->first()->id,
                    'is_approved' => 1,
                    'is_main_speaker' => 0
                ]);

                $user->assignRole('speaker');
            } elseif ($user->currentTeam->hasPendingPresentationRequest) {

                $presentationId = 0;
                foreach ($user->currentTeam->allSpeakers as $userSpeaker) {
                    if ($userSpeaker->speaker) {
                        $presentationId = $userSpeaker->speaker->presentation_id;
                        break;
                    }
                }

                Speaker::create([
                    'user_id' => $user->id,
                    'presentation_id' => $presentationId,
                    'is_approved' => 0,
                    'is_main_speaker' => 0
                ]);
            }
        }

        return redirect(config('fortify.home'))->banner(
            __('Great! You have accepted the invitation to join :team.', ['team' => $invitation->team->name]),
        );
    }

    public function companyRepShow(Request $request, TeamInvitation $invitation): View
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        return view('auth.company-rep-invitation', compact('invitation'));
    }

    public function companyRepStore(Request $request, TeamInvitation $invitation)
    {
        (new ResetUserPassword())->reset($invitation->team->owner, $request->all());
        $invitation->team->owner->email_verified_at = now()->timestamp;
        $this->guard->login($invitation->team->owner);

        $invitation->team->owner->switchTeam($invitation->team);
        $invitation->delete();

        return redirect(config('fortify.home'))->banner(
            __('Great! You have accepted the invitation to be company representative!'),
        );
    }

}

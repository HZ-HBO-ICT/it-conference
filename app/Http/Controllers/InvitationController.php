<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\ResetUserPassword;
use App\Models\Team;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Contracts\AddsTeamMembers;
use Laravel\Jetstream\TeamInvitation;

class InvitationController extends Controller
{
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
        event(new Registered($user = $creator->create($request->all())));
        $this->guard->login($user);

        app(AddsTeamMembers::class)->add(
            $invitation->team->owner,
            $invitation->team,
            $invitation->email,
            $invitation->role
        );

        $invitation->delete();
        $user->switchTeam($invitation->team);

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
        $this->guard->login($invitation->team->owner);

        $invitation->team->owner->switchTeam($invitation->team);
        $invitation->delete();

        return redirect(config('fortify.home'))->banner(
            __('Great! You have accepted the invitation to be company representative!'),
        );
    }

}

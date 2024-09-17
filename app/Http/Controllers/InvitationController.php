<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Jetstream\Jetstream;

class InvitationController extends Controller
{
    use PasswordValidationRules;

    protected $guard;

    /**
     * @param StatefulGuard $guard
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Returns the view that the user registers through ONLY if they're using an invitation
     * @param Request $request
     * @param Invitation $invitation
     * @return View
     */
    public function show(Request $request, Invitation $invitation): View
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }

        return view('auth.registration-via-invitation', compact('invitation'));
    }

    /**
     * Creates the user and adds him as a part of the team they had been invited to
     * @param Request $request
     * @param Invitation $invitation
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function register(Request $request, Invitation $invitation): RedirectResponse
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
            'company_id' => $invitation->company->id,
            'password' => Hash::make($input['password']),
        ]);

        $user->markEmailAsVerified();
        $user->assignRole([$invitation->role, 'participant']);

        $this->guard->login($user);

        $invitation->delete();

        return redirect(config('fortify.home'))->banner(
            __('Great! You have accepted the invitation to join :team.', ['team' => $invitation->company->name]),
        );
    }
}

<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     * If the user is a company representative, create a team (company) as well
     *
     * @param array<string, string> $input
     */
    public function create(array $input): User
    {
        $commonRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        $validationRules = array_key_exists('company_name', $input)
            ? array_merge($commonRules, [
                'company_name' => 'required',
                'company_description' => 'required',
                'company_website' => 'required',
                'company_address' => 'required',
            ])
            : $commonRules;

        Validator::make($input, $validationRules)->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $user->assignRole('participant');
                if (array_key_exists('company_name', $input)) {
                    $this->createTeam($user, $input['company_name'], $input['company_address'], $input['company_website'], $input['company_description']);
                }
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user, string $company_name, string $company_address, string $company_website, string $company_description): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }
}

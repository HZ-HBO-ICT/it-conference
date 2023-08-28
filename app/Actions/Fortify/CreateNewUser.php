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
        $defaultRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'institution' => [array_key_exists('company_name', $input) ? '' : 'required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        $validationRules = array_key_exists('company_name', $input)
            ? array_merge($defaultRules, [
                'company_name' => 'required',
                'company_description' => 'required',
                'company_website' => 'required',
                'company_postcode' => ['required',
                    'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
                'company_housenumber' => 'required',
                'company_street' => 'required',
                'company_city' => 'required',
            ])
            : $defaultRules;

        Validator::make($input, $validationRules)->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $user->assignRole('participant');
                if(array_key_exists('institution', $input)) {
                    $user->institution = $input['institution'];
                    $user->save();
                }
                if (array_key_exists('company_name', $input)) {
                    $this->createTeam($user, $input['company_name'], $input['company_postcode'], $input['company_housenumber'], $input['company_street'], $input['company_city'], $input['company_website'], $input['company_description']);
                }
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User   $user, string $company_name, string $company_postcode,
                                  string $company_housenumber, string $company_street,
                                  string $company_city, string $company_website,
                                  string $company_description): void
    {
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => $company_name,
            'postcode' => $company_postcode,
            'house_number' => $company_housenumber,
            'street' => $company_street,
            'city' => $company_city,
            'website' => $company_website,
            'description' => $company_description,
            'personal_team' => false,
        ]);

        $user->ownedTeams()->save($team);
        $user->switchTeam($team);
    }
}

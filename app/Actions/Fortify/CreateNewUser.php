<?php

namespace App\Actions\Fortify;

use App\Models\Company;
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
     * Validate and create a newly registered user.
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
                'company_phone_number' => ['required', 'phone:INTERNATIONAL,NL'],
                'company_postcode' => ['required',
                    'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
                'company_house_number' => ['required',
                    'regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'],
                'company_street' => 'required',
                'company_city' => 'required',
            ])
            : $defaultRules;

        $customMessages = [
            'company_phone_number.required' => 'The company phone number is required.',
            'company_phone_number.phone' => 'The company phone number is invalid.',
        ];
        Validator::make($input, $validationRules, $customMessages)->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $user->assignRole('participant');

                if (env('APP_ENV') == 'local') {
                    $user->markEmailAsVerified();
                }

                if (array_key_exists('institution', $input)) {
                    $user->institution = $input['institution'];
                    $user->save();
                }
                if (array_key_exists('company_name', $input)) {
                    $this->createTeam(
                        $user,
                        $input['company_name'],
                        $input['company_postcode'],
                        $input['company_house_number'],
                        $input['company_street'],
                        $input['company_city'],
                        $input['company_website'],
                        $input['company_phone_number'],
                        $input['company_description']
                    );
                }
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(
        User   $user,
        string $company_name,
        string $company_postcode,
        string $company_house_number,
        string $company_street,
        string $company_city,
        string $company_website,
        string $company_phone_number,
        string $company_description
    ): void {
        $company = Company::create([
            'name' => $company_name,
            'postcode' => $company_postcode,
            'house_number' => $company_house_number,
            'street' => $company_street,
            'city' => $company_city,
            'website' => $company_website,
            'description' => $company_description,
            'phone_number' => $company_phone_number,
            'personal_team' => false,
        ]);

        $user->company()->associate($company);
        $user->assignRole('company representative');
        $user->save();
    }
}

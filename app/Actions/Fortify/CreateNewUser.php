<?php

namespace App\Actions\Fortify;

use App\Models\Company;
use App\Models\InternshipAttribute;
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
            'registration_type' => ['in:participant,company_representative'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'institution' => [$input['registration_type'] == 'participant' ? 'required' : ''],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        $validationRules = $input['registration_type'] == 'participant'
            ? $defaultRules
            : array_merge($defaultRules, [
                'company_name' => 'required',
                'company_description' => 'required',
                'company_motivation' => 'required',
                'company_website' => 'required',
                'company_phone_number' => ['phone:INTERNATIONAL,NL'],
                'company_postcode' => ['required'],
                'company_house_number' => ['required',
                    'regex:/(\w?[0-9]+[a-zA-Z0-9\- ]*)$/i'],
                'company_street' => 'required',
                'company_city' => 'required',
            ]);

        Validator::make($input, $validationRules)->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) use ($input) {
                $user->assignRole('participant');

                if (config('app.env') == 'local') {
                    $user->markEmailAsVerified();
                }

                if (array_key_exists('company_name', $input)) {
                    $attributes = $this->prepareAttributes($input);

                    $this->createCompany(
                        $user,
                        $input['company_name'],
                        $input['company_postcode'],
                        $input['company_house_number'],
                        $input['company_street'],
                        $input['company_city'],
                        $input['company_website'],
                        $input['company_phone_number'],
                        $input['company_description'],
                        $input['company_motivation'],
                        $attributes
                    );
                }
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createCompany(
        User   $user,
        string $company_name,
        string $company_postcode,
        string $company_house_number,
        string $company_street,
        string $company_city,
        string $company_website,
        string $company_phone_number,
        string $company_description,
        string $company_motivation,
        $attributes
    ): void {
        $company = Company::create([
            'name' => $company_name,
            'postcode' => $company_postcode,
            'house_number' => $company_house_number,
            'street' => $company_street,
            'city' => $company_city,
            'website' => 'https://' . $company_website,
            'description' => $company_description,
            'phone_number' => $company_phone_number,
            'motivation' => $company_motivation,
            'personal_team' => false,
        ]);

        $this->storeInternshipAttributes($attributes, $company);
        $user->company()->associate($company);
        $user->assignRole('company representative');
        $user->save();
    }

    /**
     * Stores the internship details as attributes
     * @param $key
     * @param $array
     * @param $company
     * @return void
     */
    public function storeInternshipAttributes($attributes, $company)
    {
        foreach (array_keys($attributes) as $key) {
            foreach ($attributes[$key] as $attribute) {
                InternshipAttribute::create([
                    'key' => $key,
                    'value' => $attribute,
                    'company_id' => $company->id
                ]);
            };
        }
    }

    /**
     * Prepares the raw array from the request body to become more suitable for creation
     * @param $array
     * @return array
     */
    public function prepareAttributes($array)
    {
        $preparedArray = [];
        $mapping = [
            'company_internship_years' => 'year',
            'company_internship_tracks' => 'track',
            'company_internship_languages' => 'language',
        ];

        foreach ($mapping as $sourceKey => $destinationKey) {
            if (array_key_exists($sourceKey, $array)) {
                $preparedArray[$destinationKey] = array_values($array[$sourceKey]);
            }
        }

        return $preparedArray;
    }
}

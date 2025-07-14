<?php

namespace App\Console\Commands;

use App\Enums\ApprovalStatus;
use App\Models\Company;
use App\Models\User;
use Illuminate\Console\Command;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\text;

class CreateUnrestrictedCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-unrestricted-company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a command that creates a company and allows unlimited presentations';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle() : void
    {

        $check = false;
        while (!$check) {
            $email = text(
                'Please input the email of the user that will be the company representative of the unrestricted company',
                'E.g. user@example.com',
                '',
                true,
                validate: ['email' => 'required|string|email:rfc,dns|max:255|exists:users,email']
            );

            $user = User::where('email', $email)->firstOrFail();

            $hasCompany = (bool) $user->company;
            if ($hasCompany) {
                $this->error('User with email ' . $email . ' already has a company attached to them');
                continue;
            }

            $check = confirm(
                'Is ' . $user->name . ' the right user?',
                false,
                'Yes',
                'No'
            );
        }

        $name = text(
            'Company Name:',
            'E.g. HZ University of Applied Sciences',
            '',
            true,
            validate: ['name' => 'required|string|max:255']
        );

        $website = text(
            'Company Website:',
            'E.g. www.hz.nl',
            '',
            true,
            validate: ['website' => 'required|string|max:255']
        );

        $description = text(
            'Company Description:',
            'Provide a brief overview of the company.',
            '',
            true,
            validate: ['description' => 'required|string']
        );

        $postcode = text(
            'Postcode:',
            'E.g. 4331 NB',
            '',
            true,
            validate: ['postcode' => 'required|string|max:20']
        );

        $street = text(
            'Street:',
            'E.g. Het Groene Woud',
            '',
            true,
            validate: ['street' => 'required|string|max:255']
        );

        $houseNumber = text(
            'House Number:',
            'E.g. 1-3',
            '',
            true,
            validate: ['house_number' => 'required|string|max:20']
        );

        $city = text(
            'City:',
            'E.g. Middelburg',
            '',
            true,
            validate: ['city' => 'required|string|max:255']
        );

        $company = Company::create([
            'name' => $name,
            'website' => $website,
            'description' => $description,
            'postcode' => $postcode,
            'street' => $street,
            'house_number' => $houseNumber,
            'city' => $city,
            'approval_status' => ApprovalStatus::APPROVED->value,
            'sponsorship_approval_status' => ApprovalStatus::NOT_REQUESTED->value,
            'is_unlimited' => true,
        ]);

        $user->update(['company_id' => $company->id]);
        $user->assignRole('company representative');

        $this->info("Company '{$company->name}' created successfully.");
    }
}

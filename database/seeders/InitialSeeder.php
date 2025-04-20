<?php

namespace Database\Seeders;

use App\Enums\ApprovalStatus;
use App\Models\Company;
use App\Models\Edition;
use App\Models\EditionEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder is responsible for seeding the so called 'Initial stage' of the conference.
     * This stage consists of an edition that only contains dates for certain events.
     * This stage does not contain any companies, users, presentations, sponsors etc.
     */
    public function run(): void
    {
        // 1. Seed our admin user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'mod@hz.nl',
            'password' => bcrypt('123')]);
        $user->markEmailAsVerified();
        $user->assignRole('event organizer');

        // 2. Seed the company representative user
        $company = Company::factory()->create([
            'name' => 'Sample company',
            'approval_status' => ApprovalStatus::APPROVED->value
        ]);
        $user = User::create([
            'name' => 'Company rep',
            'email' => 'rep@hz.nl',
            'password' => bcrypt('123'),
            'company_id' => $company->id,
        ]);
        $user->markEmailAsVerified();
        $user->assignRole('company representative');

        // 3. Seed the participant user
        $user = User::create([
            'name' => 'Participant',
            'email' => 'par@hz.nl',
            'password' => bcrypt('123'),
        ]);
        $user->markEmailAsVerified();
        $user->assignRole('participant');

        // 4. Seed the edition and the default rooms
        $this->call([EditionSeeder::class, RoomSeeder::class]);

        // 5. Retrieve the created edition and activate it
        $edition = Edition::first();
        $edition->activate();
    }
}

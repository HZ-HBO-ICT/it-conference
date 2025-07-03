<?php

namespace Database\Seeders;

use App\Models\Edition;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// @TODO Are there any more things that need to be seeded for this stage?

class CompanyRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        activity()->withoutLogs(function () {
            // 1. Call the initial seeder to create the edition and admin user
            $this->call(InitialSeeder::class);

            // 2. Create a few companies with sponsors and presentations
            $this->call(CompanySeeder::class);

            // 3. Change the event starting date so that the company registration is open
            optional(Edition::current())->getEvent('Company registration')->update([
                'start_at' => Carbon::today(),
            ]);

            // 4. Change the presentation request starting date so that companies can request presentations
            optional(Edition::current())->getEvent('Presentation request')->update([
                'start_at' => Carbon::today(),
            ]);
        });
    }
}

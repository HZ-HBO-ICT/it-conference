<?php

namespace Database\Seeders;

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
        // 1. Call the initial seeder to create the edition and admin user
        $this->call(InitialSeeder::class);

        // 2. Create a few companies with sponsors and presentations
        $this->call(CompanySeeder::class);
    }
}

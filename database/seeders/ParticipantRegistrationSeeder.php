<?php

namespace Database\Seeders;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        activity()->withoutLogs(function () {
            // 1. Call the Company Registration Stage seeder.
            $this->call(CompanyRegistrationSeeder::class);

            // 2. Create users and presentations.
            $users = User::factory(5)
                ->create()
                ->each(function ($user) {
                    $user->assignRole('participant');
                });
            foreach ($users as $user) {
                $presentation = Presentation::factory()->create();
                $user->joinPresentation($presentation, 'speaker');
            }

            foreach (Presentation::all() as $presentation) {
                $users = User::factory(random_int(1, 100))
                    ->create()
                    ->each(function ($user) {
                        $user->assignRole('participant');
                    });

                foreach ($users as $user) {
                    $user->joinPresentation($presentation);
                }
            }
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Edition;
use App\Models\Presentation;
use App\Models\User;
use Carbon\Carbon;
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

            // 3. Change the event starting date so that the participant registration is open
            optional(Edition::current())->getEvent('Participant registration')->update([
                'start_at' => Carbon::today(),
            ]);
        });
    }
}

<?php

namespace Database\Seeders;

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
        $edition = Edition::first();

        // 1. Seed our admin user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'mod@hz.nl',
            'password' => bcrypt('123')]);
        $user->markEmailAsVerified();
        $user->assignRole('event organizer');

        // 2. Seed the new Edition
        Edition::create([
            'name' => 'We are in IT together Conference ' . Carbon::now()->year,
            'start_at' => Carbon::now()->setMonth(11)->setTime(9, 0, 0),
            'end_at' => Carbon::now()->setMonth(11)->setTime(17, 0, 0)
        ]);

        // 2a. Create 'company registration' event
        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 1,
            'start_at' => Carbon::today(),
            'end_at' => Carbon::today()->addWeek(2),
        ]);

        // 2b. Create 'participant registration' event
        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 2,
            'start_at' => Carbon::today()->addWeeks(1),
            'end_at' => Carbon::today()->addWeeks(2),
        ]);

        // 2c. Create 'presentation request' event
        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 3,
            'start_at' => Carbon::today()->addWeeks(1),
            'end_at' => Carbon::today()->addWeeks(3),
        ]);

        // 3. Activate the edition
        $edition->activate();
    }
}

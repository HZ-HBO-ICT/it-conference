<?php

namespace Database\Seeders;

use App\Models\DefaultPresentation;
use App\Models\Edition;
use App\Models\EditionEvent;
use App\Models\PresentationType;
use App\Models\Timeslot;
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

        // 2. Seed the edition and the default rooms
        $this->call([EditionSeeder::class, RoomSeeder::class]);

        // 3. Retrieve the created edition and activate it
        $edition = Edition::first();
        $edition->activate();

        // 4. Create default opening and closing presentations
        DefaultPresentation::create([
            'name' => 'Opening presentation',
            'description' => 'This is the opening presentation!',
            'start' => '08:00:00',
            'end' => '9:30:00',
            'type' => 'opening',
            'room_id' => '1',
        ]);

        DefaultPresentation::create([
            'name' => 'Closing presentation',
            'description' => 'This is the closing presentation!',
            'start' => '16:00:00',
            'end' => '17:30:00',
            'type' => 'closing',
            'room_id' => '1',
        ]);

        Timeslot::generateTimeslots();

        // 4. Seed with the presentation type (connected to the edition)
        $this->call([PresentationTypeSeeder::class]);
    }
}

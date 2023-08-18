<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
/*            SpeakerSeeder::class,*/
            RoleSeeder::class,
            ParticipantSeeder::class,
            SponsorTierSeeder::class
        ]);

        Room::factory(5)->create();

        $user = User::create([
            'name' => 'Content moderator',
            'email' => 'mod@hz.nl',
            'password' => Hash::make('123')
        ]);

        $user->assignRole('content moderator');
    }
}

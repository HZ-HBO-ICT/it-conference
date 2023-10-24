<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Speaker;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First seed all the master data
        Artisan::call('admin:upsert-master-data');

        $user = User::create([
            'name' => 'Content moderator',
            'email' => 'mod@hz.nl',
            'password' => Hash::make('123')
        ]);
        $user->assignRole('content moderator');

        User::create([
            'name' => 'Test Account',
            'email' => 'testacc@hz.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
        ]);

        // Create some rooms
        Room::factory(5)->create();

        Presentation::factory(15)->has(Speaker::factory())->create();
        $presentations = Presentation::all();

        // Populate the presentations with participants
        User::all()->each(function ($user) use ($presentations) {
            $user->presentations()->attach(
                $presentations->random(rand(1, 5))->pluck('id')->toArray()
            );
        });

        Team::factory(1)->create([
            'sponsor_tier_id' => 1
        ]);

        Team::factory(2)->create([
            'sponsor_tier_id' => 2
        ]);

        Team::factory(5)->create([
            'sponsor_tier_id' => 3
        ]);

    }
}

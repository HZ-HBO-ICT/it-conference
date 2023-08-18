<?php

namespace Database\Seeders;

use App\Models\Presentation;
use App\Models\Speaker;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Test Account',
            'email' => 'testacc@hz.nl',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        Presentation::factory(15)->has(Speaker::factory())->create();
        $presentations = Presentation::all();

        // Populate the pivot table
        User::all()->each(function ($user) use ($presentations) {
            $user->presentations()->attach(
                $presentations->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}

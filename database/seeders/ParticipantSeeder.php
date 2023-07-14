<?php

namespace Database\Seeders;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presentation::factory(5)->create();

        User::factory()->create();

        $presentations = Presentation::all();

        // Populate the pivot table
        User::all()->each(function ($user) use ($presentations) {
            $user->presentations()->attach(
                $presentations->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}

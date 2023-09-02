<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

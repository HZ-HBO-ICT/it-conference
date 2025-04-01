<?php

namespace Database\Seeders;

use App\Models\Edition;
use App\Models\PresentationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresentationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $edition = Edition::current();

        PresentationType::create([
            'name' => 'Workshop',
            'description' => 'A presentation in which you can showcase a skill and teach the participants',
            'duration' => 90,
            'edition_id' => $edition->id,
        ]);

        PresentationType::create([
            'name' => 'Lecture',
            'description' => 'A presentation in which you can share something you are passionate about',
            'duration' => 30,
            'edition_id' => $edition->id,
        ]);

        PresentationType::create([
            'name' => 'IT Talk',
            'description' => 'A presentation in which you and the participants discuss a topic',
            'duration' => 60,
            'edition_id' => $edition->id,
        ]);
    }
}

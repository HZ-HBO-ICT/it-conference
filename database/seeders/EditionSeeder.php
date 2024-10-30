<?php

namespace Database\Seeders;

use App\Models\Edition;
use App\Models\EditionEvent;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Edition::create([
            'name' => 'We are in IT together Conference ' . date('Y'),
            'start_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 17:00:00')),
        ]);

        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 1,
            'start_at' => Carbon::now(),
            'end_at' => Carbon::now()->addWeeks(2),
        ]);

        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 2,
            'start_at' => Carbon::now(),
            'end_at' => Carbon::now()->addWeeks(2),
        ]);

        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 3,
            'start_at' => Carbon::now(),
            'end_at' => Carbon::now()->addWeeks(2),
        ]);
    }
}

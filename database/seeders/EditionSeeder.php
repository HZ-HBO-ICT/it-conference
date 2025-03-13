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
            'name' => 'We are in IT together Conference ' . Carbon::now()->year,
            'start_at' => Carbon::now()->addMonths(11)->setTime(9, 0),
            'end_at' => Carbon::now()->addMonths(11)->setTime(17, 0),
        ]);

        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 1,
            'start_at' => Carbon::today()->addWeek(),
            'end_at' => Carbon::today()->addWeeks(2),
        ]);

        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 2,
            'start_at' => Carbon::today()->addWeek(),
            'end_at' => Carbon::today()->addWeeks(2),
        ]);

        EditionEvent::create([
            'edition_id' => 1,
            'event_id' => 3,
            'start_at' => Carbon::today()->addWeek(),
            'end_at' => Carbon::today()->addWeeks(3),
        ]);
    }
}

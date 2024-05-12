<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Stats\SpeakersStats;
use App\Stats\BoothsStats;
use App\Stats\PresentationsStats;
use App\Stats\CompaniesStats;
use Carbon\Carbon;

class StatsSeeder extends Seeder
{
    public function run()
    {
        // Simulate stats for the past 30 days
        for ($i = 30; $i >= 0; $i--) {
            $dateString = Carbon::today()->subDays($i)->toDateString();
            $date = Carbon::createFromFormat('Y-m-d', $dateString);

            SpeakersStats::increase(rand(1, 5), $date);
            BoothsStats::increase(rand(1, 3), $date);
            PresentationsStats::increase(rand(1, 4), $date);
            CompaniesStats::increase(rand(1, 2), $date);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Booth;
use App\Models\Company;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserPresentation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('admin:upsert-master-data');

        Room::factory()->count(20)->create();

        $this->call([CompanySeeder::class, UserSeeder::class, PermissionSeeder::class]);

        $startTime = 8; // 8 AM
        $endTime = 18;  // 6 PM
        $currentTime = $startTime;

        while ($currentTime < $endTime) {
            $time = sprintf('%02d:00', $currentTime); // Formats time like "08:00", "09:00", etc.
            Timeslot::create([
                'start' => $time,
                'duration' => 30
            ]);
            $time = sprintf('%02d:30', $currentTime); // Half hour mark
            Timeslot::create([
                'start' => $time,
                'duration' => 30
            ]);
            $currentTime++; // Move to the next hour
        }
    }
}

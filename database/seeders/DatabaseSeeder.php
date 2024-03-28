<?php

namespace Database\Seeders;

use App\Models\Presentation;
use App\Models\Room;
use App\Models\Timeslot;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Timeslot::factory()->count(20)->create();
        Presentation::factory()->count(20)->create();
    }
}

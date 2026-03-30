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
use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app(\Spatie\Activitylog\Support\ActivityLogStatus::class)->disable();

        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');

        $this->call([EditionSeeder::class, PresentationTypeSeeder::class, RoomSeeder::class, CompanySeeder::class, UserSeeder::class]);

        app(\Spatie\Activitylog\Support\ActivityLogStatus::class)->enable();
    }
}

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
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');

        foreach ($this->roomNames as $roomName) {
            Room::factory()->create([
                'name' => $roomName
            ]);
        }

        $this->call([CompanySeeder::class, UserSeeder::class, EditionSeeder::class]);
    }

    public $roomNames = [
        'GW027',
        'GW011',
        'GW012',
        'GW013',
        'GW014',
        'GW317',
        'GW319',
        'RC213'
    ];
}

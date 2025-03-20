<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roomNames as $roomName) {
            Room::factory()->create([
                'name' => $roomName
            ]);
        }
    }

    /** @var string[] */
    public array $roomNames = [
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

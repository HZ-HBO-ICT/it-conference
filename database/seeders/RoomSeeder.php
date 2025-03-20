<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run() {
        foreach ($this->roomNames as $roomName) {
            Room::factory()->create([
                'name' => $roomName
            ]);
        }
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

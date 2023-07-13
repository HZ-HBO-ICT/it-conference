<?php

namespace Database\Seeders;

use App\Models\SponsorTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SponsorTier::create([
            'name' => 'golden',
            'max_sponsors' => '1'
        ]);

        SponsorTier::create([
            'name' => 'silver',
            'max_sponsors' => '2'
        ]);

        SponsorTier::create([
            'name' => 'bronze',
            'max_sponsors' => '5'
        ]);
    }
}

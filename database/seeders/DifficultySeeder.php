<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Difficulty::create([
            'level' => 'beginner',
            'description' => 'for those new to the subject; Provides a solid introduction'
        ]);

        Difficulty::create([
            'level' => 'intermediate',
            'description' => 'Ready to delve deeper? Suitable for those with some prior knowledge'
        ]);

        Difficulty::create([
            'level' => 'expert',
            'description' => 'Challenge yourself with these advanced presentations'
        ]);
    }
}

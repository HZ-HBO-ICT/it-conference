<?php

namespace Database\Seeders;

use App\Models\Presentation;
use App\Models\User;
use App\Models\UserPresentation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')]);

        $users = User::factory(5)->create();
        foreach ($users as $user) {
            $presentation = Presentation::factory()->create();
            $user->joinPresentation($presentation, 'speaker');
        }

        foreach (Presentation::all() as $presentation) {
            $users = User::factory(random_int(1, 10))->create();

            foreach ($users as $user) {
                $user->joinPresentation($presentation);
            }
        }
    }
}

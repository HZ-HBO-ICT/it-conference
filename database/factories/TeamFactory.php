<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'user_id' => User::factory(),
            'personal_team' => true,
            'postcode' => '1234 AB',
            'house_number' => '1',
            'street' => '123 Main St',
            'city' => 'Lorem ipsum',
            'website' => 'https://example.com',
            'description' => 'Lorem ipsum dolar sit amet',
            //random pic for logo
            'logo_path' => 'https://picsum.photos/100/50',
            'is_approved' => true,
            'is_sponsor_approved' => true
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Difficulty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presentation>
 */
class PresentationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'max_participants' => $this->faker->numberBetween(1, 200),
            'type' => $this->faker->boolean ? 'workshop' : 'lecture',
            'difficulty_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}

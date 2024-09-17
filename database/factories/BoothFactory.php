<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booth>
 */
class BoothFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "width" => $this->faker->numberBetween(0, 3),
            "length" => $this->faker->numberBetween(0, 3),
            "is_approved" => false
        ];
    }
}

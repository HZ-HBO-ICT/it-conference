<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TimeslotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start' => $this->faker->dateTimeBetween('9:00', '17:00')->format('H:i'),
            'duration' => $this->faker->randomElement([60, 90])
        ];
    }
}

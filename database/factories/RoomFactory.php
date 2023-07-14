<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['GW308', 'GW212', 'GW401', 'GW305', 'GW317', 'GW319', 'GW027']),
            'max_participants' => $this->faker->numberBetween(20, 30)
        ];
    }
}

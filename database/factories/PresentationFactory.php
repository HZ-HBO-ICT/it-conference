<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Timeslot;
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
            'name' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'max_participants' => $this->faker->numberBetween(10, 20),
            'type' => $this->faker->randomElement(['presentation', 'workshop']),
            'timeslot_id' => Timeslot::factory()->create()->id,
            'room_id' => Room::factory()->create()->id
        ];
    }
}

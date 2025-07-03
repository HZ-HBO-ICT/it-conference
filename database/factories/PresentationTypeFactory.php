<?php

namespace Database\Factories;

use App\Models\Edition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PresentationType>
 */
class PresentationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'duration' => $this->faker->numberBetween(10, 200),
            'colour' => $this->faker->randomElement(config('colours')),
            'edition_id' => optional(Edition::current())->id,
        ];
    }
}

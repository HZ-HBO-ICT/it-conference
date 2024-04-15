<?php

namespace Database\Factories;

use App\Models\Presentation;
use App\Models\Sponsorship;
use App\Models\UserPresentation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'website' => $this->faker->url,
            'description' => $this->faker->paragraph(),
            'phone_number' => $this->faker->phoneNumber,
            'postcode' => '1234 AB',
            'is_approved' => false,
            'street' => $this->faker->streetAddress,
            'house_number' => $this->faker->numberBetween(0, 10),
            'city' => $this->faker->city
        ];
    }

    /**
     * Assigns the passed sponsorship to a fake company
     * @return CompanyFactory|Factory
     */
    public function hasSponsorship($sponsorshipTypeName)
    {
        $sponsorship = Sponsorship::where('name', $sponsorshipTypeName)->first();

        return $this->state(function (array $attributes) use ($sponsorship) {
            return [
                'sponsorship_id' => $sponsorship->id
            ];
        });
    }
}

<?php

namespace Database\Factories;

use App\Enums\ApprovalStatus;
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
            'approval_status' => $this->faker->boolean
                ? ApprovalStatus::APPROVED->value
                : ApprovalStatus::AWAITING_APPROVAL->value,
        ];
    }
}

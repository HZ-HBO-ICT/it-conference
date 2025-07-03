<?php

namespace Database\Factories;

use App\Enums\ApprovalStatus;
use App\Models\Booth;
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

    /**
     * Specify the approval status of the entity
     * @param ApprovalStatus|string $status
     * @return Factory<Booth>
     */
    public function setApprovalStatus(ApprovalStatus|string $status) :  Factory
    {
        $statusValue = $status instanceof ApprovalStatus ? $status->value : $status;
        return $this->state(function (array $attributes) use ($statusValue) {
            return [
                'approval_status' => $statusValue,
            ];
        });
    }
}

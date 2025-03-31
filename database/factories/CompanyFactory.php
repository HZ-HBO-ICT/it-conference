<?php

namespace Database\Factories;

use App\Enums\ApprovalStatus;
use App\Models\Company;
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
            'website' => 'https://www.example.com',
            'description' => $this->faker->paragraph(),
            'motivation' => $this->faker->paragraph(),
            'phone_number' => $this->faker->phoneNumber,
            'postcode' => '1234 AB',
            'street' => $this->faker->streetAddress,
            'house_number' => $this->faker->numberBetween(0, 10),
            'city' => $this->faker->city,
            'logo_path' => 'logos/img.png',
            'approval_status' => $this->faker->boolean
                ? ApprovalStatus::APPROVED->value
                : ApprovalStatus::AWAITING_APPROVAL->value,
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
                'sponsorship_id' => $sponsorship->id,
                'sponsorship_approval_status' => ApprovalStatus::APPROVED->value,
                'approval_status' => ApprovalStatus::APPROVED->value,
            ];
        });
    }

    /**
     * Specify the approval status of the entity
     * @param ApprovalStatus|string $status
     * @return Factory<Company>
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

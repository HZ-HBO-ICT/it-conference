<?php

namespace Database\Factories;

use App\Enums\ApprovalStatus;
use App\Models\Presentation;
use App\Models\PresentationType;
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
            'name' => $this->faker->randomElement($this->presentationTopics),
            'description' => $this->faker->paragraph,
            'max_participants' => $this->faker->numberBetween(1, 200),
            'presentation_type_id' => $this->faker->randomElement(PresentationType::all()->pluck('id')),
            'difficulty_id' => $this->faker->numberBetween(1, 3),
            'approval_status' => $this->faker->boolean
                ? ApprovalStatus::APPROVED->value
                : ApprovalStatus::AWAITING_APPROVAL->value,
        ];
    }

    /**
     * Specify the approval status of the entity
     * @param ApprovalStatus|string $status
     * @return Factory<Presentation>
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

    public $presentationTopics = [
        'Debugging: The Art of Turning Coffee into Code',
        'When Code Goes Rogue: Hilarious Debugging Stories',
        'The Internet of (Silly) Things',
        'Cloud Computing: No, It’s Not About the Weather',
        'AI: Artificial Insanity?',
        'How to Train Your Robot (Not to Steal Your Job)',
        'The Secret Life of Bugs: A Developer\'s Worst Nightmare',
        'WiFi Woes: Why Does My Internet Hate Me?',
        'Hacking 101: How to Make Friends and Annoy People',
        'The Evolution of Memes: From Dial-Up to Fiber Optic',
        'Data Breaches: The New Horror Stories',
        'From Floppy Disks to USB: The Quest for More Space',
        'The Great Debate: Tabs vs Spaces',
        'Virtual Reality: Escaping Meetings Since 2020',
        'Blockchain: The Magic Behind Cryptocurrency Unicorns',
        'Cybersecurity: Because Clicking That Link Was a Bad Idea',
        'The Rise of the Machines: Are We in a Sci-Fi Movie?',
        'Passwords: Keep Calm and Don’t Use ‘123456’',
        'Software Updates: The Good, the Bad, and the Ugly',
        'The Browser Wars: Chrome vs Firefox vs The World',
        'Code Reviews: When Your Code is Judged by Humans',
        'Server Downtime: The Apocalypse of the Digital Age',
        'The AI Uprising: Will Siri and Alexa Take Over?',
        'When Tech Support Becomes Tech Sport',
        'The Dark Web: Not as Fun as It Sounds',
        'Backup Plans: Because Murphy’s Law Applies to IT',
        'The Cloud: Where Data Goes to Party',
        'Internet Explorer: A Moment of Silence',
        'Agile Development: Running in Circles Productively',
        'The Joy of Legacy Code: Archaeology for Programmers'
    ];
}

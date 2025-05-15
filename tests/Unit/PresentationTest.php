<?php

namespace Tests\Unit;

use App\Enums\ApprovalStatus;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\PresentationType;
use App\Models\User;
use Database\Seeders\PresentationTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PresentationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        activity()->disableLogging();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
        Edition::create([
            'name' => 'test',
            'state' => Edition::STATE_ANNOUNCE,
            'start_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 17:00:00')),
        ]);
        $this->seed(PresentationTypeSeeder::class);
    }

    #[Test]
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    #[Test]
    public function test_that_speakers_returns_the_users_attached_with_role_speaker(): void
    {
        $users = User::factory(3)->create();
        $presentation = Presentation::factory()->create();
        foreach ($users as $user) {
            $user->joinPresentation($presentation, 'speaker');
        }
        $presentation->refresh();

        $speakers = $presentation->speakers;

        $this->assertEquals($speakers->count(), $users->count());
    }

    #[Test]
    public function test_that_participants_returns_the_users_attached_with_role_participant(): void
    {
        $users = User::factory(3)->create();
        $presentation = Presentation::factory()->create();
        foreach ($users as $user) {
            $user->joinPresentation($presentation);
        }
        $presentation->refresh();

        $participants = $presentation->participants;

        $this->assertEquals($participants->count(), $users->count());
    }

    #[Test]
    public function test_that_you_cannot_create_presentation_with_invalid_approval_status(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid approval status: test');
        $presentationType = PresentationType::firstOrFail();

        $user = User::factory()->create();
        $presentation = Presentation::create([
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'presentation_type_id' => $presentationType->id,
            'difficulty_id' => 1,
            'max_participants' => 50,
            'approval_status' => ApprovalStatus::AWAITING_APPROVAL->value,
            'user_id' => $user->id
        ]);

        $presentation->approval_status = 'test';
        $presentation->save();
    }

    #[Test]
    public function test_that_you_can_create_presentation_with_valid_approval_status(): void
    {
        $user = User::factory()->create();
        $presentationType = PresentationType::firstOrFail();

        $presentation = Presentation::create([
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'presentation_type_id' => $presentationType->id,
            'difficulty_id' => 1,
            'max_participants' => 50,
            'approval_status' => ApprovalStatus::AWAITING_APPROVAL->value,
            'user_id' => $user->id
        ]);

        $presentation->save();

        $this->assertDatabaseHas('presentations', ['id' => $presentation->id, 'approval_status' => ApprovalStatus::AWAITING_APPROVAL->value]);
    }
}

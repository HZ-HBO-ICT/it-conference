<?php

namespace Tests\Unit;

use App\Enums\ApprovalStatus;
use App\Models\Presentation;
use App\Models\User;
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

        $user = User::factory()->create();
        $presentation = Presentation::create([
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'type' => 'workshop',
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
        $presentation = Presentation::create([
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'type' => 'workshop',
            'difficulty_id' => 1,
            'max_participants' => 50,
            'approval_status' => ApprovalStatus::AWAITING_APPROVAL->value,
            'user_id' => $user->id
        ]);

        $presentation->save();

        $this->assertDatabaseHas('presentations', ['id' => $presentation->id, 'approval_status' => ApprovalStatus::AWAITING_APPROVAL->value]);
    }
}

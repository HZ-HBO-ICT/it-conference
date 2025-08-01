<?php

namespace Tests\Feature;

use App\Enums\ApprovalStatus;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\PresentationType;
use App\Models\User;
use Database\Seeders\PresentationTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PresentationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
    public function event_organizer_can_view_presentations(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.presentations.index'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.presentations.index');
        $response->assertViewHas('presentations');
    }

    #[Test]
    public function participant_cannot_view_presentations(): void
    {
        $user = User::factory()->create()->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.presentations.index'));

        $response->assertStatus(403);
    }

    #[Test]
    public function event_organizer_can_access_create_presentation_form(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.presentations.create'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.presentations.create');
    }

    #[Test]
    public function participant_cannot_access_create_presentation_form(): void
    {
        $user = User::factory()->create()->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.presentations.create'));

        $response->assertStatus(403);
    }

    #[Test]
    public function event_organizer_can_store_presentation(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $speaker = User::factory()->create()->assignRole('participant');
        $presentationType = PresentationType::firstOrFail();

        $presentationData = [
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'presentation_type_id' => $presentationType->id,
            'difficulty_id' => 1,
            'max_participants' => 50,
            'user_id' => $speaker->id
        ];

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.store'), $presentationData);

        $response->assertRedirect(route('moderator.presentations.index'));
        $this->assertDatabaseHas('presentations', ['name' => 'New Tech Trends']);
    }

    #[Test]
    public function participant_cannot_store_presentation(): void
    {
        $user = User::factory()->create()->assignRole('participant');
        $speaker = User::factory()->create()->assignRole('participant');
        $presentationType = PresentationType::firstOrFail();

        $presentationData = [
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'presentation_type_id' => $presentationType->id,
            'difficulty_id' => 1,
            'max_participants' => 50,
            'user_id' => $speaker->id
        ];

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.store'), $presentationData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('presentations', ['name' => $presentationData['name']]);
    }

    #[Test]
    public function event_organizer_receives_validation_errors_on_invalid_presentation_data() : void
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $invalidPresentationData = [
            'name' => '',
            'description' => '',
            'presentation_type_id' => '',
            'difficulty_id' => null,
            'max_participants' => null,
            'user_id' => 'abc'
        ];

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.store'), $invalidPresentationData);

        $response->assertSessionHasErrors([
            'name', 'description', 'presentation_type_id', 'difficulty_id', 'max_participants'
        ]);

        $this->assertDatabaseMissing('presentations', ['name' => $invalidPresentationData['name']]);
    }

    #[Test]
    public function event_organizer_can_view_presentation_details(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.presentations.show', $presentation));

        $response->assertStatus(200);
        $response->assertViewIs('crew.presentations.show');
        $response->assertViewHas('presentation', $presentation);
    }

    #[Test]
    public function participant_cannot_view_presentation_details(): void
    {
        $user = User::factory()->create()->assignRole('participant');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.presentations.show', $presentation));

        $response->assertStatus(403);
    }

    #[Test]
    public function event_organizer_can_approve_presentation(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->setApprovalStatus(ApprovalStatus::AWAITING_APPROVAL->value)->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.approve', ['presentation' => $presentation, 'isApproved' => 1]));

        $response->assertRedirect(route('moderator.presentations.show', $presentation));
        $this->assertDatabaseHas('presentations', ['id' => $presentation->id, 'approval_status' => ApprovalStatus::APPROVED->value]);
    }

    #[Test]
    public function event_organizer_can_reject_presentation(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->setApprovalStatus(ApprovalStatus::APPROVED->value)->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.approve', ['presentation' => $presentation, 'isApproved' => 0]));

        $response->assertRedirect(route('moderator.presentations.index'));
        $this->assertDatabaseMissing('presentations', ['id' => $presentation->id, 'approval_status' => ApprovalStatus::APPROVED->value]);
    }

    #[Test]
    public function participant_cannot_approve_or_reject_presentation(): void
    {
        $user = User::factory()->create()->assignRole('participant');
        $presentation = Presentation::factory()->setApprovalStatus(ApprovalStatus::AWAITING_APPROVAL->value)->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.approve', ['presentation' => $presentation, 'isApproved' => 1]));

        $response->assertStatus(403);
        $this->assertDatabaseHas('presentations', ['id' => $presentation->id, 'approval_status' => ApprovalStatus::AWAITING_APPROVAL->value]);
    }

    #[Test]
    public function event_organizer_can_delete_presentation(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('moderator.presentations.destroy', $presentation));

        $response->assertRedirect(route('moderator.presentations.index'));
        $this->assertDatabaseMissing('presentations', ['id' => $presentation->id]);
    }

    #[Test]
    public function participant_cannot_delete_presentation(): void
    {
        $user = User::factory()->create()->assignRole('participant');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('moderator.presentations.destroy', $presentation));

        $response->assertStatus(403);
        $this->assertDatabaseHas('presentations', ['id' => $presentation->id]);
    }
}

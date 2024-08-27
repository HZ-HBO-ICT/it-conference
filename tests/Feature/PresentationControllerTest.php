<?php

namespace Tests\Feature;

use App\Models\Edition;
use App\Models\Presentation;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PresentationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
        Edition::create([
            'name' => 'test',
            'state' => Edition::STATE_ANNOUNCE,
            'start_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 17:00:00')),
        ]);
    }

    /** @test */
    public function event_organizer_can_view_presentations()
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.presentations.index'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.presentations.index');
        $response->assertViewHas('presentations');
    }

    /** @test */
    public function participant_cannot_view_presentations()
    {
        $user = User::factory()->create()->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.presentations.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function event_organizer_can_access_create_presentation_form()
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.presentations.create'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.presentations.create');
    }

    /** @test */
    public function participant_cannot_access_create_presentation_form()
    {
        $user = User::factory()->create()->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.presentations.create'));

        $response->assertStatus(403);
    }

    /** @test */
    public function event_organizer_can_store_presentation()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $speaker = User::factory()->create()->assignRole('participant');
        $presentationData = [
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'type' => 'workshop',
            'difficulty_id' => 1,
            'max_participants' => 50,
            'user_id' => $speaker->id
        ];

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.store'), $presentationData);

        $response->assertRedirect(route('moderator.presentations.index'));
        $this->assertDatabaseHas('presentations', ['name' => 'New Tech Trends']);
    }

    /** @test */
    public function participant_cannot_store_presentation()
    {
        $user = User::factory()->create()->assignRole('participant');
        $speaker = User::factory()->create()->assignRole('participant');
        $presentationData = [
            'name' => 'New Tech Trends',
            'description' => 'A look into future technologies.',
            'type' => 'Tech',
            'difficulty_id' => 1,
            'max_participants' => 50,
            'user_id' => $speaker->id
        ];

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.store'), $presentationData);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('presentations', ['name' => $presentationData['name']]);
    }

    /** @test */
    public function event_organizer_receives_validation_errors_on_invalid_presentation_data()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $speaker = User::factory()->create()->assignRole('participant');

        $invalidPresentationData = [
            'name' => '',
            'description' => '',
            'type' => '',
            'difficulty_id' => null,
            'max_participants' => null,
            'user_id' => 'abc'
        ];

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.store'), $invalidPresentationData);

        $response->assertSessionHasErrors([
            'name', 'description', 'type', 'difficulty_id', 'max_participants'
        ]);

        $this->assertDatabaseMissing('presentations', ['name' => $invalidPresentationData['name']]);
    }

    /** @test */
    public function event_organizer_can_view_presentation_details()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.presentations.show', $presentation));

        $response->assertStatus(200);
        $response->assertViewIs('crew.presentations.show');
        $response->assertViewHas('presentation', $presentation);
    }

    /** @test */
    public function participant_cannot_view_presentation_details()
    {
        $user = User::factory()->create()->assignRole('participant');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.presentations.show', $presentation));

        $response->assertStatus(403);
    }

    /** @test */
    public function event_organizer_can_approve_presentation()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->create(['is_approved' => false]);

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.approve', $presentation), ['approved' => true]);

        $response->assertRedirect(route('moderator.presentations.show', $presentation));
        $this->assertDatabaseHas('presentations', ['id' => $presentation->id, 'is_approved' => true]);
    }

    /** @test */
    public function event_organizer_can_reject_presentation()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->create(['is_approved' => true]);

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.approve', $presentation), ['approved' => false]);

        $response->assertRedirect(route('moderator.presentations.index'));
        $this->assertDatabaseMissing('presentations', ['id' => $presentation->id, 'is_approved' => false]);
    }

    /** @test */
    public function participant_cannot_approve_or_reject_presentation()
    {
        $user = User::factory()->create()->assignRole('participant');
        $presentation = Presentation::factory()->create();
        $presentation->is_approved = false;
        $presentation->save();

        $response = $this->actingAs($user)
            ->post(route('moderator.presentations.approve', $presentation), ['approved' => true]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('presentations', ['id' => $presentation->id, 'is_approved' => false]);
    }

    /** @test */
    public function event_organizer_can_delete_presentation()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('moderator.presentations.destroy', $presentation));

        $response->assertRedirect(route('moderator.presentations.index'));
        $this->assertDatabaseMissing('presentations', ['id' => $presentation->id]);
    }

    /** @test */
    public function participant_cannot_delete_presentation()
    {
        $user = User::factory()->create()->assignRole('participant');
        $presentation = Presentation::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('moderator.presentations.destroy', $presentation));

        $response->assertStatus(403);
        $this->assertDatabaseHas('presentations', ['id' => $presentation->id]);
    }
}

<?php

namespace Tests\Feature\Livewire\PresentationType;

use App\Enums\ApprovalStatus;
use App\Livewire\PresentationType\CreateEditModal;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\PresentationType;
use App\Models\Room;
use App\Models\Timeslot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateEditModalTest extends TestCase
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
            'start_at' => date('Y-m-d H:i:s', strtotime('2025-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2025-11-18 17:00:00')),
        ]);
    }

    #[Test]
    public function test_that_it_displays_create_modal_component_correctly(): void
    {
        $edition = optional(Edition::current());

        Livewire::test(CreateEditModal::class, ['editionId' => $edition->id])
            ->assertStatus(200)
            ->assertSee('Create new presentation type');
    }

    #[Test]
    public function test_that_it_displays_edit_modal_component_correctly(): void
    {
        $presentationType = PresentationType::factory()->create();

        Livewire::test(CreateEditModal::class, ['editionId' => $presentationType->edition_id, 'presentationTypeId' => $presentationType->id])
            ->assertStatus(200)
            ->assertSee("Edit $presentationType->name");
    }

    #[Test]
    public function test_that_it_validates_required_fields_on_store(): void
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $edition = optional(Edition::current());

        $this->actingAs($user);

        Livewire::test(CreateEditModal::class, ['editionId' => $edition->id])
            ->call('store')
            ->assertHasErrors(['name', 'description', 'duration', 'colour']);
    }

    #[Test]
    public function test_that_it_creates_a_presentation_type_successfully_with_permission(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('create presentation type');
        $edition = optional(Edition::current());

        Livewire::actingAs($user)
            ->test(CreateEditModal::class, ['editionId' => $edition->id])
            ->set('name', 'Lightning Talk')
            ->set('description', 'Short, punchy talk.')
            ->set('duration', 15)
            ->set('colour', config('colours')[0])
            ->call('store');

        $this->assertDatabaseHas('presentation_types', [
            'name' => 'Lightning Talk',
            'description' => 'Short, punchy talk.',
            'edition_id' => $edition->id,
        ]);
    }

    #[Test]
    public function test_that_it_fails_when_creating_a_presentation_type_without_permission(): void
    {
        $user = User::factory()->create();
        $edition = optional(Edition::current());

        Livewire::actingAs($user)
            ->test(CreateEditModal::class, ['editionId' => $edition->id])
            ->set('name', 'Lightning Talk')
            ->set('description', 'Short, punchy talk.')
            ->set('duration', 15)
            ->set('colour', config('colours')[0])
            ->call('store')
            ->assertForbidden();
    }


    #[Test]
    public function test_that_it_updates_a_presentation_type_successfully_with_permission(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('update presentation type');
        $edition = optional(Edition::current());
        $presentationType = PresentationType::factory()->create([
            'edition_id' => $edition->id,
            'name' => 'Original Name',
        ]);

        Livewire::actingAs($user)
            ->test(CreateEditModal::class, [
                'editionId' => $edition->id,
                'presentationTypeId' => $presentationType->id,
            ])
            ->set('name', 'Lightning Talk')
            ->set('description', 'Short, punchy talk.')
            ->set('duration', 15)
            ->set('colour', config('colours')[0])
            ->call('update');

        $this->assertDatabaseHas('presentation_types', [
            'name' => 'Lightning Talk',
            'description' => 'Short, punchy talk.',
            'edition_id' => $edition->id,
        ]);
    }

    #[Test]
    public function test_that_it_fails_when_updating_a_presentation_type_without_permission(): void
    {
        $user = User::factory()->create();
        $edition = optional(Edition::current());
        $presentationType = PresentationType::factory()->create([
            'edition_id' => $edition->id,
            'name' => 'Original Name',
        ]);

        Livewire::actingAs($user)
            ->test(CreateEditModal::class, [
                'editionId' => $edition->id,
                'presentationTypeId' => $presentationType->id,
            ])
            ->set('name', 'Lightning Talk')
            ->set('description', 'Short, punchy talk.')
            ->set('duration', 15)
            ->set('colour', config('colours')[0])
            ->call('update')
            ->assertForbidden();
    }

    #[Test]
    public function test_that_it_warns_about_scheduled_presentations(): void
    {
        $edition = optional(Edition::current());
        $presentationType = PresentationType::factory()->create([
            'duration' => 45,
        ]);
        $timeslot = Timeslot::create([
            'start' => '08:00:00',
            'duration' => 30
        ]);
        $room = Room::factory()->create();

        Presentation::factory()->create([
            'presentation_type_id' => $presentationType->id,
            'approval_status' => ApprovalStatus::APPROVED->value,
            'timeslot_id' => $timeslot->id,
            'room_id' => $room->id,
            'start' => $timeslot->start,
        ]);

        Livewire::test(CreateEditModal::class, [
                'editionId' => $edition->id,
                'presentationTypeId' => $presentationType->id,
            ])
            ->set('duration', 30)
            ->assertSet('presentationType.duration', 45)
            ->call('showWarningMessage')
            ->assertReturned(true);
    }
}

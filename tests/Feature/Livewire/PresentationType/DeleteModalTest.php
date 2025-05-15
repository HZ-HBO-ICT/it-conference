<?php

namespace Tests\Feature\Livewire\PresentationType;

use App\Livewire\PresentationType\DeleteModal;
use App\Models\Edition;
use App\Models\PresentationType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteModalTest extends TestCase
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
        $presentationType = PresentationType::factory()->create();

        Livewire::test(DeleteModal::class, ['presentationTypeId' => $presentationType->id])
            ->assertStatus(200)
            ->assertSee("Delete $presentationType->name");
    }

    #[Test]
    public function test_that_it_successfully_deletes_presentation_type_with_permission(): void
    {
        $presentationType = PresentationType::factory()->create();
        $user = User::factory()->create();
        $user->givePermissionTo('delete presentation type');

        Livewire::actingAs($user)
            ->test(DeleteModal::class, ['presentationTypeId' => $presentationType->id])
            ->call('delete');

        $this->assertDatabaseMissing('presentation_types', [
            'id' => $presentationType->id,
            'name' => $presentationType->name,
        ]);
    }

    #[Test]
    public function test_that_it_fails_when_deleting_presentation_type_without_permission(): void
    {
        $presentationType = PresentationType::factory()->create();
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(DeleteModal::class, ['presentationTypeId' => $presentationType->id])
            ->call('delete')
            ->assertForbidden();

        $this->assertDatabaseHas('presentation_types', [
            'id' => $presentationType->id,
            'name' => $presentationType->name,
        ]);
    }
}

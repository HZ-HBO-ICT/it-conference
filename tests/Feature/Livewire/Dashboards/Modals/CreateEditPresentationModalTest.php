<?php

namespace Tests\Feature\Livewire\Dashboards\Modals;

use App\Enums\ApprovalStatus;
use App\Livewire\Dashboards\Modals\CompanyDetailsModal;
use App\Livewire\Dashboards\Modals\CreateEditPresentationModal;
use App\Models\Company;
use App\Models\Difficulty;
use App\Models\Edition;
use App\Models\EditionEvent;
use App\Models\Event;
use App\Models\Presentation;
use App\Models\PresentationType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CreateEditPresentationModalTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        activity()->disableLogging();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
        Artisan::call('db:seed --class=EditionSeeder');
        optional(Edition::first())->activate();
        EditionEvent::where('event_id', 3)->firstOrFail()->update([
            'start_at' => Carbon::now(),
        ]);
        Artisan::call('db:seed --class=PresentationTypeSeeder');

        Storage::fake('public');
    }

    #[Test]
    public function test_that_it_can_mount_the_component_only_with_user_for_creating() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        $component = Livewire::test(CreateEditPresentationModal::class, ['userId' => $user->id, 'presentationId' => null]);

        $component->assertSet('presentation', null)
            ->assertSet('file', null)
            ->assertSet('form.name', null);
    }

    #[Test]
    public function test_that_it_can_mount_the_component_with_user_and_presentation_for_editing() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $presentation = Presentation::factory()->create(['company_id' => $company->id]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->joinPresentation($presentation, 'speaker');
        $user->refresh();

        $component = Livewire::test(CreateEditPresentationModal::class, ['userId' => $user->id, 'presentationId' => $presentation->id]);

        $component->assertSet('presentation.id', $presentation->id)
            ->assertSet('file', null)
            ->assertSet('form.name', $presentation->name);
    }

    #[Test]
    public function test_it_can_render_the_component() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        $component = Livewire::test(CreateEditPresentationModal::class, ['userId' => $user->id, 'presentationId' => null]);

        $component->assertViewIs('livewire.dashboards.modals.create-edit-presentation-modal');
    }

    #[Test]
    public function test_it_returns_correct_modal_max_width() : void
    {
        $this->assertEquals('5xl', CreateEditPresentationModal::modalMaxWidth());
    }

    #[Test]
    public function test_it_throws_authorization_error_when_user_doesnt_have_permission() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $presentation = Presentation::factory()->create(['company_id' => $company->id]);
        $user = User::factory()->create();
        $user->assignRole('company representative');
        $user->refresh();

        Livewire::test(CreateEditPresentationModal::class, ['userId' => $user->id, 'presentationId' => $presentation->id])
            ->call('save')
            ->assertForbidden();
    }

    #[Test]
    public function test_it_validates_input_fields_when_creating_presentation() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        $component = Livewire::actingAs($user)
            ->test(CreateEditPresentationModal::class, ['userId' => $user->id, 'presentationId' => null])
            ->set('form.name', '')
            ->set('form.description', '')
            ->set('form.presentation_type_id', '')
            ->set('form.max_participants', '')
            ->set('form.difficulty_id', '');

        $component
            ->call('save')
            ->assertHasErrors(
                ['form.name',
                    'form.description',
                    'form.presentation_type_id',
                    'form.max_participants',
                    'form.difficulty_id'
                ]
            );
    }

    #[Test]
    public function test_it_validates_input_fields_when_editing_presentation() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $presentation = Presentation::factory()->create(['company_id' => $company->id]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->joinPresentation($presentation, 'speaker');
        $user->refresh();

        $component = Livewire::actingAs($user)
            ->test(CreateEditPresentationModal::class, ['userId' => $user->id, 'presentationId' => $presentation->id])
            ->set('form.name', '')
            ->set('form.description', '')
            ->set('form.presentation_type_id', '')
            ->set('form.max_participants', '')
            ->set('form.difficulty_id', '');

        $component
            ->call('save')
            ->assertHasErrors(
                ['form.name',
                    'form.description',
                    'form.presentation_type_id',
                    'form.max_participants',
                    'form.difficulty_id'
                ]
            );
    }

    #[Test]
    public function test_it_creates_presentation_with_valid_input() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        $presentationType = PresentationType::firstOrFail();
        $difficulty = Difficulty::firstOrFail();

        $component = Livewire::actingAs($user)
            ->test(CreateEditPresentationModal::class, ['user' => $user, 'presentationId' => null])
            ->set('form.name', 'Awesome Presentation')
            ->set('form.description', 'This is a description of an awesome presentation.')
            ->set('form.presentation_type_id', $presentationType->id)
            ->set('form.max_participants', 100)
            ->set('form.difficulty_id', $difficulty->id);

        $component
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('presentations', [
            'name' => 'Awesome Presentation',
            'description' => 'This is a description of an awesome presentation.',
            'presentation_type_id' => $presentationType->id,
            'max_participants' => 100,
            'difficulty_id' => $difficulty->id,
            'company_id' => $company->id,
        ]);
    }

    #[Test]
    public function test_it_updates_presentation_with_valid_input() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $presentation = Presentation::factory()->create(['company_id' => $company->id]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative', 'participant');
        $user->joinPresentation($presentation, 'speaker');
        $user->refresh();

        $newType = PresentationType::firstOrFail();
        $newDifficulty = Difficulty::firstOrFail();

        $component = Livewire::actingAs($user)
            ->test(CreateEditPresentationModal::class, ['user' => $user, 'presentationId' => $presentation->id])
            ->set('form.name', 'Updated Presentation Title')
            ->set('form.description', 'Updated description.')
            ->set('form.presentation_type_id', $newType->id)
            ->set('form.max_participants', 50)
            ->set('form.difficulty_id', $newDifficulty->id);

        $component
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('presentations', [
            'id' => $presentation->id,
            'name' => 'Updated Presentation Title',
            'description' => 'Updated description.',
            'presentation_type_id' => $newType->id,
            'max_participants' => 50,
            'difficulty_id' => $newDifficulty->id,
        ]);
    }


    #[Test]
    public function test_everything_resets_on_cancel() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $presentation = Presentation::factory()->create(['company_id' => $company->id]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->joinPresentation($presentation, 'speaker');
        $user->refresh();

        Storage::fake();
        $file = UploadedFile::fake()->image('file.pdf');

        Livewire::actingAs($user)
            ->test(CreateEditPresentationModal::class, ['userId' => $user->id, 'presentationId' => $presentation->id])
            ->set('form.name', 'Changed Name')
            ->set('file', $file)
            ->call('cancel')
            ->assertSet('file', null)
            ->assertSet('form.name', $presentation->name);
    }
}

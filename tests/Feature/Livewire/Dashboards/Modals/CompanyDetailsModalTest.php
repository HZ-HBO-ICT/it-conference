<?php

namespace Tests\Feature\Livewire\Dashboards\Modals;

use App\Enums\ApprovalStatus;
use App\Livewire\Dashboards\Modals\CompanyDetailsModal;
use App\Models\Company;
use App\Models\Edition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CompanyDetailsModalTest extends TestCase
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

        Storage::fake('public');
    }

    #[Test]
    public function test_that_it_can_mount_the_component_with_a_company() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(CompanyDetailsModal::class, ['company' => $company])
            ->assertSet('company', $company)
            ->assertSet('editing', false)
            ->assertSet('photo', null);
    }

    #[Test]
    public function test_it_can_render_the_component() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(CompanyDetailsModal::class, ['company' => $company])
            ->assertViewIs('livewire.dashboards.modals.company-details-modal');
    }

    #[Test]
    public function test_it_returns_correct_modal_max_width() : void
    {
        $this->assertEquals('7xl', CompanyDetailsModal::modalMaxWidth());
    }

    #[Test]
    public function test_it_saves_company_details_with_valid_input() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        $component = Livewire::actingAs($user)
            ->test(CompanyDetailsModal::class, ['company' => $company])
            ->set('form.name', 'Valid Company Name')
            ->set('form.description', 'A description for the company.')
            ->set('form.website', 'https://example.com')
            ->set('form.phone_number', '+1 (775) 795-6897')
            ->set('form.postcode', '4331NB')
            ->set('form.street', '123 Main St')
            ->set('form.city', 'Metropolis');

        $component
            ->call('save')
            ->assertHasNoErrors();
    }

    #[Test]
    public function test_it_throws_authorization_error_when_user_is_not_company_representative() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company member');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(CompanyDetailsModal::class, ['company' => $company])
            ->call('save')
            ->assertForbidden();
    }

    #[Test]
    public function test_it_throws_authorization_error_when_user_is_not_from_the_company() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create();
        $user->assignRole('company representative');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(CompanyDetailsModal::class, ['company' => $company])
            ->call('save')
            ->assertForbidden();
    }

    #[Test]
    public function test_it_validates_input_fields() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        $component = Livewire::actingAs($user)
            ->test(CompanyDetailsModal::class, ['company' => $company])
            ->set('form.name', '')
            ->set('form.description', '')
            ->set('form.website', '')
            ->set('form.phone_number', '')
            ->set('form.postcode', '')
            ->set('form.street', '')
            ->set('form.city', '');

        $component
            ->call('save')
            ->assertHasErrors(
                ['form.name',
                'form.description',
                'form.website',
                'form.phone_number',
                'form.postcode',
                'form.street',
                'form.city']
            );
    }

    #[Test]
    public function test_everything_resets_on_cancel() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        Storage::fake();
        $file = UploadedFile::fake()->image('logo.png');

        Livewire::actingAs($user)
            ->test(CompanyDetailsModal::class, ['company' => $company])
            ->set('form.name', 'Changed Name')
            ->set('photo', $file)
            ->call('cancel')
            ->assertSet('photo', null)
            ->assertSet('form.name', $company->name);
    }
}

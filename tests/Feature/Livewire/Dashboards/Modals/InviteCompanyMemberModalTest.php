<?php

namespace Tests\Feature\Livewire\Dashboards\Modals;

use App\Enums\ApprovalStatus;
use App\Livewire\Dashboards\Modals\InviteCompanyMemberModal;
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

class InviteCompanyMemberModalTest extends TestCase
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
    public function test_that_it_can_mount_the_component_with_a_company() : void
    {
        $company = Company::factory()->create();
        $component = Livewire::test(InviteCompanyMemberModal::class, ['company' => $company]);

        $component->assertSet('company', $company)
            ->assertSet('currentRole', null)
            ->assertSet('email', null);
    }

    #[Test]
    public function test_it_can_render_the_component() : void
    {
        $company = Company::factory()->create();
        $component = Livewire::test(InviteCompanyMemberModal::class, ['company' => $company]);

        $component->assertViewIs('livewire.dashboards.modals.invite-company-member-modal');
    }

    #[Test]
    public function test_it_saves_company_details_with_valid_input() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        $component = Livewire::actingAs($user)
            ->test(InviteCompanyMemberModal::class, ['company' => $company])
            ->set('email', 'example@example.com')
            ->set('currentRole', 'speaker');

        $component
            ->call('invite')
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
            ->test(InviteCompanyMemberModal::class, ['company' => $company])
            ->call('invite')
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
            ->test(InviteCompanyMemberModal::class, ['company' => $company])
            ->call('invite')
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
            ->test(InviteCompanyMemberModal::class, ['company' => $company])
            ->set('email', '')
            ->set('currentRole', 'invalid');

        $component
            ->call('invite')
            ->assertHasErrors(
                ['email',
                'currentRole',
                ]
            );
    }

    #[Test]
    public function test_everything_resets_on_cancel() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(InviteCompanyMemberModal::class, ['company' => $company])
            ->set('email', 'example@example.com')
            ->set('currentRole', 'speaker')
            ->call('cancel')
            ->assertSet('email', null)
            ->assertSet('currentRole', false);
    }
}

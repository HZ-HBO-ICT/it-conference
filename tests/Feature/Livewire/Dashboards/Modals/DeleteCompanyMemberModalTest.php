<?php

namespace Tests\Feature\Livewire\Dashboards\Modals;

use App\Enums\ApprovalStatus;
use App\Livewire\Dashboards\Modals\DeleteCompanyMemberModal;
use App\Livewire\Dashboards\Modals\InviteCompanyMemberModal;
use App\Models\Company;
use App\Models\Edition;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DeleteCompanyMemberModalTest extends TestCase
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
    public function test_that_it_can_mount_the_component_with_an_id() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->refresh();

        $component = Livewire::test(DeleteCompanyMemberModal::class, ['id' => $user->id, 'isInvitation' => false]);

        $component->assertSet('member.id', $user->id)
            ->assertSet('isInvitation', false);
    }

    #[Test]
    public function test_it_can_render_the_component() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->refresh();

        $component = Livewire::test(DeleteCompanyMemberModal::class, ['id' => $user->id, 'isInvitation' => false]);

        $component->assertViewIs('livewire.dashboards.modals.delete-company-member-modal');
    }

    #[Test]
    public function test_it_throws_authorization_error_when_user_is_not_company_representative() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $toBeDeletedUser = User::factory()->create(['company_id' => $company->id]);
        $toBeDeletedUser->refresh();
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company member');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(DeleteCompanyMemberModal::class, ['id' => $user->id, 'isInvitation' => false])
            ->call('delete')
            ->assertForbidden();
    }

    #[Test]
    public function test_user_gets_deleted_successfully() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $toBeDeletedUser = User::factory()->create(['company_id' => $company->id]);
        $toBeDeletedUser->refresh();
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(DeleteCompanyMemberModal::class, ['id' => $toBeDeletedUser->id, 'isInvitation' => false])
            ->call('delete');

        $this->assertDatabaseMissing('users', ['id' => $toBeDeletedUser->id]);
    }

    #[Test]
    public function test_invitation_gets_deleted_successfully() : void
    {
        $company = Company::factory()->create(['approval_status' => ApprovalStatus::APPROVED->value]);
        $toBeDeleted = Invitation::create(['email' => 'email@email.com', 'company_id' => $company->id, 'role' => 'speaker']);
        $user = User::factory()->create(['company_id' => $company->id]);
        $user->assignRole('company representative');
        $user->refresh();

        Livewire::actingAs($user)
            ->test(DeleteCompanyMemberModal::class, ['id' => $toBeDeleted->id, 'isInvitation' => true])
            ->call('delete');

        $this->assertDatabaseMissing('invitations', ['id' => $toBeDeleted->id]);
    }
}

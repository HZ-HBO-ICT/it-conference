<?php

namespace Tests\Unit;

use App\Enums\ApprovalStatus;
use App\Models\Booth;
use App\Models\Company;
use App\Models\Presentation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyTest extends TestCase
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
    public function test_that_you_cannot_create_company_with_invalid_approval_status(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid approval status: test');

        $company = Company::factory()->make();
        $company->approval_status = 'test';

        $company->save();
    }

    #[Test]
    public function test_that_you_can_create_company_with_valid_approval_status(): void
    {
        $company = Company::factory()->make([
            'approval_status' => ApprovalStatus::APPROVED->value
        ]);

        $company->save();

        $this->assertDatabaseHas(
            'companies',
            ['id' => $company->id, 'approval_status' => ApprovalStatus::APPROVED->value]
        );
    }

    #[Test]
    public function test_that_you_cannot_store_sponsorship_status_with_invalid_approval_status(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid approval status: test');

        $company = Company::factory()->make();
        $company->sponsorship_approval_status = 'test';

        $company->save();
    }

    #[Test]
    public function test_that_you_can_store_sponsorship_status_with_valid_approval_status(): void
    {
        $company = Company::factory()->make([
            'sponsorship_approval_status' => ApprovalStatus::APPROVED->value
        ]);

        $company->save();

        $this->assertDatabaseHas(
            'companies',
            ['id' => $company->id, 'sponsorship_approval_status' => ApprovalStatus::APPROVED->value]
        );
    }
}

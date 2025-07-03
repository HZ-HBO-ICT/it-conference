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

class BoothTest extends TestCase
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
    public function test_that_you_cannot_create_booth_with_invalid_approval_status(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid approval status: test');

        $company = Company::factory()->create();
        $booth = Booth::create([
            'width' => 1,
            'length' => 2,
            'company_id' => $company->id,
            'approval_status' => 'test'
        ]);

        $booth->save();
    }

    #[Test]
    public function test_that_you_can_create_booth_with_valid_approval_status(): void
    {
        $company = Company::factory()->create();
        $booth = Booth::create([
            'width' => 1,
            'length' => 2,
            'company_id' => $company->id,
            'approval_status' => ApprovalStatus::APPROVED->value,
        ]);

        $booth->save();

        $this->assertDatabaseHas('booths', ['id' => $booth->id, 'approval_status' => ApprovalStatus::APPROVED->value]);
    }
}

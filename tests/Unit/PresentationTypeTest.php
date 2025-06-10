<?php

namespace Tests\Unit;

use App\Enums\ApprovalStatus;
use App\Models\Edition;
use App\Models\Presentation;
use App\Models\PresentationType;
use App\Models\Room;
use App\Models\Timeslot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PresentationTypeTest extends TestCase
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
            'start_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 17:00:00')),
        ]);
    }

    #[Test]
    public function test_it_can_be_safely_deleted_when_no_presentations_exist() : void
    {
        $type = PresentationType::factory()->create();

        $this->assertTrue($type->canBeSafelyDeleted());
    }

    #[Test]
    public function test_it_cannot_be_safely_deleted_when_presentations_exist() : void
    {
        $type = PresentationType::factory()->create();
        Presentation::factory()->create(['presentation_type_id' => $type->id]);

        $this->assertFalse($type->canBeSafelyDeleted());
    }

    #[Test]
    public function test_it_can_be_safely_updated_when_no_presentations_exist() : void
    {
        $type = PresentationType::factory()->create();

        $this->assertTrue($type->canBeSafelyUpdated());
    }

    #[Test]
    public function test_it_can_be_safely_updated_when_no_approved_scheduled_presentations_exist() : void
    {
        $type = PresentationType::factory()->create();

        Presentation::factory()->create([
            'presentation_type_id' => $type->id,
            'approval_status' => ApprovalStatus::AWAITING_APPROVAL->value,
        ]);

        $this->assertTrue($type->canBeSafelyUpdated());
    }

    #[Test]
    public function test_it_cannot_be_safely_updated_when_approved_presentations_are_scheduled() : void
    {
        $type = PresentationType::factory()->create();
        $timeslot = Timeslot::create([
            'start' => '08:00:00',
            'duration' => 30
        ]);
        $room = Room::factory()->create();

        Presentation::factory()->create([
            'presentation_type_id' => $type->id,
            'approval_status' => ApprovalStatus::APPROVED->value,
            'timeslot_id' => $timeslot->id,
            'room_id' => $room->id,
            'start' => $timeslot->start,
        ]);

        $this->assertFalse($type->canBeSafelyUpdated());
    }

    #[Test]
    public function test_it_counts_unscheduled_approved_presentations_correctly() : void
    {
        $type = PresentationType::factory()->create();
        $timeslot = Timeslot::create([
            'start' => '08:00:00',
            'duration' => 30
        ]);
        $room = Room::factory()->create();

        Presentation::factory()->count(2)->create([
            'presentation_type_id' => $type->id,
            'approval_status' => ApprovalStatus::APPROVED->value,
            'timeslot_id' => null,
            'room_id' => null,
            'start' => null,
        ]);

        Presentation::factory()->create([
            'presentation_type_id' => $type->id,
            'approval_status' => ApprovalStatus::APPROVED->value,
            'timeslot_id' => $timeslot->id,
            'room_id' => $room->id,
            'start' => $timeslot->start,
        ]);

        $this->assertEquals(2, $type->unscheduledPresentationCount());
    }
}

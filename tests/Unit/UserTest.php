<?php

namespace Tests\Unit;

use App\Models\Presentation;
use App\Models\User;
use App\Models\UserPresentation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Spatie\Activitylog\Models\Activity;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        activity()->disableLogging();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_that_user_can_enrol_as_participant_in_presentation(): void
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();

        $isSuccessful = $user->joinPresentation($presentation);

        $this->assertTrue(UserPresentation::where('user_id', $user->id)
            ->where('presentation_id', $presentation->id)
            ->where('role', 'participant')
            ->exists());
        $this->assertEquals(1, UserPresentation::count());
        $this->assertTrue($isSuccessful);
    }

    public function test_that_user_cannot_enrol_as_participant_in_presentation_if_they_already_are_enrolled(): void
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();
        $user->joinPresentation($presentation);
        $user->refresh();

        $isSuccessful = $user->joinPresentation($presentation);

        $this->assertEquals(1, UserPresentation::count());
        $this->assertFalse($isSuccessful);
    }

    public function test_that_user_can_become_speaker_in_presentation(): void
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();

        $isSuccessful = $user->joinPresentation($presentation, 'speaker');

        $this->assertTrue(UserPresentation::where('user_id', $user->id)
            ->where('presentation_id', $presentation->id)
            ->where('role', 'speaker')
            ->exists());
        $this->assertEquals(1, UserPresentation::count());
        $this->assertTrue($isSuccessful);
    }

    public function test_that_user_cannot_become_speaker_in_presentation_if_they_are_speaker_already(): void
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();
        $user->joinPresentation($presentation, 'speaker');
        $presentation = Presentation::factory()->create();
        $user->refresh();

        $isSuccessful = $user->joinPresentation($presentation, 'speaker');

        $this->assertEquals(1, UserPresentation::count());
        $this->assertFalse($isSuccessful);
    }

    public function test_that_user_cannot_become_participant_in_presentation_if_they_are_speaker_in_it(): void
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();
        $user->joinPresentation($presentation, 'speaker');
        $user->refresh();

        $isSuccessful = $user->joinPresentation($presentation);

        $this->assertEquals(1, UserPresentation::count());
        $this->assertFalse($isSuccessful);
    }

    public function test_that_user_can_leave_presentation_when_participant(): void
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();
        UserPresentation::create([
            'user_id' => $user->id,
            'presentation_id' => $presentation->id,
            'role' => 'participant'
        ]);

        $user->leavePresentation($presentation);

        $this->assertEquals(0, UserPresentation::count());
    }

    public function test_that_user_cannot_leave_presentation_when_speaker(): void
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();
        UserPresentation::create([
            'user_id' => $user->id,
            'presentation_id' => $presentation->id,
            'role' => 'speaker'
        ]);

        $user->leavePresentation($presentation);

        $this->assertEquals(1, UserPresentation::count());
    }

    public function test_that_speaker_returns_presentation_where_user_is_speaker()
    {
        $user = User::factory()->create();
        $presentation = Presentation::factory()->create();
        $user->joinPresentation($presentation, 'speaker');

        $retrievedPresentation = $user->presenter_of;

        $this->assertEquals($retrievedPresentation->id, $presentation->id);
    }

    public function test_that_participant_returns_presentation_where_user_is_enrolled_as_participant()
    {
        $user = User::factory()->create();
        $presentations = Presentation::factory(5)->create();
        foreach ($presentations as $presentation) {
            $user->joinPresentation($presentation);
        }
        $user->refresh();

        $retrievedPresentations = $user->participating_in;

        $this->assertEquals($retrievedPresentations->count(), $presentations->count());
    }
}

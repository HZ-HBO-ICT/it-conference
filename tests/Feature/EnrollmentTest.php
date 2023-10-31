<?php

namespace Tests\Feature;

use App\Events\FinalProgrammeReleased;
use App\Models\Presentation;
use App\Models\Room;
use App\Models\Speaker;
use App\Models\Timeslot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('admin:upsert-master-data');
    }

    private function arrangePresentation()
    {
        $room = Room::factory()->create();
        $presentation = Presentation::factory()->create();
        $timeslot = Timeslot::factory()->create();

        $presentation->room_id = $room->id;
        $presentation->timeslot_id = $timeslot->id;
        $presentation->difficulty_id = 2;

        $presentation->save();

        FinalProgrammeReleased::dispatch();

        return $presentation;
    }

    public function test_that_unauthenticated_user_cannot_enroll()
    {
        // Arrange
        $presentation = $this->arrangePresentation();
        $route = route('my.programme.enroll', $presentation);

        // Act
        $response = $this->post($route);

        // Assert
        $response->assertRedirect(route('login'));
    }

    public function test_that_authenticated_user_can_enroll_when_no_other_enrollments()
    {
        // Arrange
        $presentation = $this->arrangePresentation();
        $user = User::factory()->create();
        $route = route('my.programme.enroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('participants', 1);
        $this->assertDatabaseHas('participants', [
            'user_id' => $user->id,
            'presentation_id' => $presentation->id]);

    }

    public function test_that_authenticated_user_can_enroll_when_no_clashing_enrollments()
    {
        // Arrange
        $user = User::factory()->create();
        $presentation = $this->arrangePresentation();

        $otherPresentation = $this->arrangePresentation();
        $otherPresentation->timeslot->start = Carbon::parse($presentation->timeslot->start)
            ->addMinutes(100)->format('H:i');
        $otherPresentation->timeslot->save();
        $user->presentations()->attach($otherPresentation);

        $route = route('my.programme.enroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('participants', 2);
        $this->assertDatabaseHas('participants', [
            'user_id' => $user->id,
            'presentation_id' => $presentation->id]);
    }

    public function test_that_authenticated_user_cannot_enroll_when_already_enrolled_in_the_same_presentation()
    {
        // Arrange
        $user = User::factory()->create();
        $presentation = $this->arrangePresentation();
        $user->presentations()->attach($presentation);

        $dangerResponse = [
            "bannerStyle" => "danger",
            "banner" => "You cannot enroll in this presentation",
        ];;

        $route = route('my.programme.enroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHas('flash', $dangerResponse);
        $this->assertDatabaseCount('participants', 1);
    }

    public function test_that_authenticated_user_cannot_enroll_when_clashing_enrollments()
    {
        // Arrange
        $user = User::factory()->create();
        $presentation = $this->arrangePresentation();

        $otherPresentation = $this->arrangePresentation();
        $otherPresentation->timeslot->start = $presentation->timeslot->start;
        $otherPresentation->timeslot->save();
        $user->presentations()->attach($otherPresentation);

        $dangerResponse = [
            "bannerStyle" => "danger",
            "banner" => "You cannot enroll in this presentation",
        ];;

        $route = route('my.programme.enroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHas('flash', $dangerResponse);
        $this->assertDatabaseCount('participants', 1);
    }

    public function test_that_authenticated_user_cannot_enroll_when_they_are_speaker_at_the_same_time()
    {
        // Arrange
        $user = User::factory()->create();
        $presentation = $this->arrangePresentation();

        $speakerAtPresentation = $this->arrangePresentation();
        $speakerAtPresentation->timeslot->start = $presentation->timeslot->start;
        $speakerAtPresentation->timeslot->save();

        Speaker::create([
            'user_id' => $user->id,
            'presentation_id' => $presentation->id,
            'is_main_speaker' => 1,
            'is_approved' => 1
        ]);

        $dangerResponse = [
            "bannerStyle" => "danger",
            "banner" => "You cannot enroll in this presentation",
        ];;

        $route = route('my.programme.enroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHas('flash', $dangerResponse);
        $this->assertDatabaseCount('participants', 0);
    }

    public function test_that_authenticated_user_cannot_enroll_when_presentation_has_no_available_spots()
    {
        // Arrange
        $user = User::factory()->create();
        $presentation = $this->arrangePresentation();
        $presentation->max_participants = 0;
        $presentation->save();

        $dangerResponse = [
            "bannerStyle" => "danger",
            "banner" => "You cannot enroll in this presentation",
        ];;

        $route = route('my.programme.enroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHas('flash', $dangerResponse);
        $this->assertDatabaseCount('participants', 0);
    }

    public function test_that_unauthenticated_user_cannot_deregister()
    {
        // Arrange
        $presentation = $this->arrangePresentation();
        $route = route('my.programme.disenroll', $presentation);

        // Act
        $response = $this->post($route);

        // Assert
        $response->assertRedirect(route('login'));
    }


    public function test_that_authenticated_user_can_deregister_from_presentation()
    {
        // Arrange
        $user = User::factory()->create();
        $presentation = $this->arrangePresentation();
        $user->presentations()->attach($presentation);

        $route = route('my.programme.disenroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('participants', 0);
    }

    public function test_that_authenticated_user_cannot_deregister_from_presentation_he_has_not_registered_for()
    {
        // Arrange
        $user = User::factory()->create();
        $presentation = $this->arrangePresentation();

        $dangerResponse = [
            "bannerStyle" => "danger",
            "banner" => "You are not enrolled in this presentation",
        ];;

        $route = route('my.programme.disenroll', $presentation);

        // Act
        $response = $this->actingAs($user)->post($route);

        // Assert
        $response->assertSessionHas('flash', $dangerResponse);
        $this->assertDatabaseCount('participants', 0);
    }
}

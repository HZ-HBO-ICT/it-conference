<?php

namespace Tests\Unit;

use App\Models\Presentation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PresentationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('admin:upsert-master-data');
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_that_speakers_returns_the_users_attached_with_role_speaker()
    {
        $users = User::factory(3)->create();
        $presentation = Presentation::factory()->create();
        foreach ($users as $user) {
            $user->joinPresentation($presentation, 'speaker');
        }
        $presentation->refresh();

        $speakers = $presentation->speakers;

        $this->assertEquals($speakers->count(), $users->count());
    }

    public function test_that_participants_returns_the_users_attached_with_role_participant()
    {
        $users = User::factory(3)->create();
        $presentation = Presentation::factory()->create();
        foreach ($users as $user) {
            $user->joinPresentation($presentation);
        }
        $presentation->refresh();

        $participants = $presentation->participants;

        $this->assertEquals($participants->count(), $users->count());
    }
}

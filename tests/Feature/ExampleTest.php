<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\SponsorTier;
use App\Models\Team;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        SponsorTier::factory()->has(Team::factory())->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

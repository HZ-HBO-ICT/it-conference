<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        SponsorTier::create([
            'name' => 'golden',
            'max_sponsors' => 1
        ]);
        Team::factory()->create(['sponsor_tier_id' => SponsorTier::where('name', 'golden')->first()->id]);
        $route = route('welcome');

        $response = $this->get($route);

        $response->assertStatus(200);
    }
}

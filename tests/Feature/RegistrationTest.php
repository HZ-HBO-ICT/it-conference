<?php

namespace Tests\Feature;

use App\Models\Edition;
use App\Models\EditionEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
        $edition = Edition::create([
            'name' => 'test',
            'state' => Edition::STATE_ANNOUNCE,
            'start_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 17:00:00')),
        ]);

        EditionEvent::create([
            'edition_id' => $edition->id,
            'event_id' => 1,
            'start_at' => Carbon::today(),
            'end_at' => Carbon::tomorrow(),
        ]);
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register/company');

        $response->assertStatus(200);
    }

    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    public function test_new_users_can_register(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@hz.nl',
            'password' => 'Pa$$worDD@123!!',
            'password_confirmation' => 'Pa$$worDD@123!!',
            'institution' => "HZ University of Applied Sciences",
            'registration_type' => 'participant',
            'terms' => 'on',
        ]);


        $response->assertValid();
        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_new_users_cannot_register_with_invalid_email(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'asdasda@asdasd.asda',
            'password' => 'Pa$$worDD@123!!',
            'password_confirmation' => 'Pa$$worDD@123!!',
            'institution' => "HZ University of Applied Sciences",
            'registration_type' => 'participant',
            'terms' => 'on',
        ]);

        $response->assertInvalid(['email']);
    }
}

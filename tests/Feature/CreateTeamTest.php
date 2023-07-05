<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\CreateTeamForm;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_teams_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        Livewire::test(CreateTeamForm::class)
            ->set(['state' => [
                'company_name' => 'Test Team',
                'company_address' => '123 Main St',
                'company_website' => 'https://example.com',
                'company_description' => 'Lorem ipsum dolar sit amet'
            ]])
            ->call('createTeam');

        $this->assertNotEmpty($user->fresh()->allTeams()->where('name', 'Test Team')->all());
    }
}

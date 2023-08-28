<?php

namespace Tests\Feature;

use App\Actions\Jetstream\CreateTeam;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\CreateTeamForm;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_teams_can_be_created(): void
    {
        Role::create(['name' => 'content moderator']);
        $user = User::factory()->create();
        $user->role('content moderator');
        $this->actingAs($user);
        $oldTeamsCount = Team::count();

        Livewire::test(CreateTeamForm::class)
            ->set(['state' => [
                'company_name' => 'Test Team',
                'company_postcode' => '1234 AB',
                'company_house_number' => '1',
                'company_city' => 'Lorem ipsum',
                'company_street' => '123 Main St',
                'company_website' => 'https://example.com',
                'company_description' => 'Lorem ipsum dolar sit amet',
                'rep_name' => 'John Doe',
                'rep_email' => 'john@doe.com'
            ]])
            ->call('createTeam');

        Livewire::test(CreateTeamForm::class)
            ->assertSet('state.name', '');
    }

}

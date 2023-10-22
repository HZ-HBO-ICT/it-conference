<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\DeleteTeamForm;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_teams_can_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        Role::create(['id' => 1, 'name' => 'participant', 'guard_name' => 'web']);

        $user->ownedTeams()->save($team = Team::factory()->make([
            'personal_team' => false,
            'name' => 'Test Team',
            'postcode' => '1234 AB',
            'house_number' => '1',
            'city' => 'Lorem ipsum',
            'street' => '123 Main St',
            'website' => 'https://example.com',
            'description' => 'Lorem ipsum dolar sit amet'
        ]));

        $team->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'test-role']
        );

        $component = Livewire::test(DeleteTeamForm::class, ['team' => $team->fresh()])
            ->call('deleteTeam');

        $this->assertNull($team->fresh());
        $this->assertCount(0, $otherUser->fresh()->teams);
    }

    public function test_personal_teams_cant_be_deleted(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $component = Livewire::test(DeleteTeamForm::class, ['team' => $user->currentTeam])
            ->call('deleteTeam')
            ->assertHasErrors(['team']);

        $this->assertNotNull($user->currentTeam->fresh());
    }
}

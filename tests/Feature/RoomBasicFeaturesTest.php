<?php

namespace Tests\Feature;

use App\Models\Room;
use App\Models\SponsorTier;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoomBasicFeaturesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        SponsorTier::factory()->has(Team::factory())->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_that_all_rooms_are_showed_if_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $route = route('rooms.index');
        $rooms = Room::factory(5)->create();

        $user->assignRole('content moderator');

        // Act
        $response = $this->actingAs($user)->get($route);

        // Assert
        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $response->assertViewIs('moderator.rooms.index');
        $response->assertViewHas('rooms', $rooms);
    }

    public function test_that_no_rooms_are_showed_if_not_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'participant']);
        $route = route('rooms.index');
        $rooms = Room::factory(5)->create();

        $user->assignRole('participant');

        // Act
        $response = $this->actingAs($user)->get($route);

        // Assert
        $response->assertForbidden();
    }

    public function test_that_create_room_is_showed_if_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $route = route('rooms.create');

        $user->assignRole('content moderator');

        // Act
        $response = $this->actingAs($user)->get($route);

        // Assert
        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $response->assertViewIs('moderator.rooms.create');
    }

    public function test_that_create_room_is_not_showed_if_not_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'participant']);
        $route = route('rooms.create');

        $user->assignRole('participant');

        // Act
        $response = $this->actingAs($user)->get($route);

        // Assert
        $response->assertForbidden();
    }

    public function test_that_room_is_stored_if_moderator_and_valid_data(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $user->assignRole('content moderator');

        $route = route('rooms.store');
        $requestBody = [
            'name' => 'GW317',
            'max_participants' => 15
        ];
        $roomsOldCount = Room::count();

        // Act
        $response = $this->actingAs($user)->post($route, $requestBody);

        // Assert
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('rooms.index'));

        $this->assertDatabaseCount('rooms', $roomsOldCount + 1);
        $this->assertDatabaseHas('rooms', [
            'name' => 'GW317'
        ]);
    }

    public function test_that_room_is_not_stored_if_invalid_data(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $user->assignRole('content moderator');

        $route = route('rooms.store');
        $requestBody = [
            'name' => 'GW317',
            'max_participants' => -1
        ];
        $roomsOldCount = Room::count();

        // Act
        $response = $this->actingAs($user)->post($route, $requestBody);

        // Assert
        $response->assertSessionHasErrors(['max_participants']);
        $this->assertDatabaseCount('rooms', $roomsOldCount);
    }

    public function test_that_room_is_not_stored_if_a_room_with_the_same_name_exists(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $user->assignRole('content moderator');
        Room::create([
            'name' => 'GW317',
            'max_participants' => 12
        ]);

        $route = route('rooms.store');
        $requestBody = [
            'name' => 'GW317',
            'max_participants' => -1
        ];
        $roomsOldCount = Room::count();

        // Act
        $response = $this->actingAs($user)->post($route, $requestBody);

        // Assert
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseCount('rooms', $roomsOldCount);
    }

    public function test_that_room_is_not_stored_if_not_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'participant']);
        $user->assignRole('participant');

        $route = route('rooms.store');
        $requestBody = [
            'name' => 'GW317',
            'max_participants' => -1
        ];
        $roomsOldCount = Room::count();

        // Act
        $response = $this->actingAs($user)->post($route, $requestBody);

        // Assert
        $response->assertForbidden();
    }

    public function test_that_edit_room_is_showed_if_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $room = Room::factory()->create();
        $route = route('rooms.edit', $room);

        $user->assignRole('content moderator');

        // Act
        $response = $this->actingAs($user)->get($route);

        // Assert
        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $response->assertViewIs('moderator.rooms.edit');
    }

    public function test_that_edit_room_is_not_showed_if_not_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'participant']);
        $room = Room::factory()->create();
        $route = route('rooms.edit', $room);

        $user->assignRole('participant');

        // Act
        $response = $this->actingAs($user)->get($route);

        // Assert
        $response->assertForbidden();
    }

    public function test_that_room_is_updated_if_moderator_and_valid_data(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $user->assignRole('content moderator');
        $room = Room::factory()->create();

        $oldParticipants = $room->max_participants;
        $route = route('rooms.update', $room);
        $requestBody = [
            'max_participants' => $oldParticipants + 1
        ];

        // Act
        $response = $this->actingAs($user)->put($route, $requestBody);

        // Assert
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('rooms.index'));
        $this->assertDatabaseHas('rooms', [
            'name' => $room->name,
            'max_participants' => $oldParticipants + 1
        ]);
    }

    public function test_that_room_name_is_not_updated_even_if_moderator_and_valid_data(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $user->assignRole('content moderator');
        $room = Room::factory()->create();

        $oldParticipants = $room->max_participants;
        $oldName = $room->name;
        $route = route('rooms.update', $room);
        $requestBody = [
            'name' => $room->name . '1',
            'max_participants' => $oldParticipants + 1
        ];

        // Act
        $response = $this->actingAs($user)->put($route, $requestBody);

        // Assert
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('rooms.index'));
        $this->assertDatabaseHas('rooms', [
            'name' => $oldName,
            'max_participants' => $oldParticipants + 1
        ]);
    }

    public function test_that_room_is_not_updated_if_not_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'participant']);
        $user->assignRole('participant');
        $room = Room::factory()->create();

        $oldParticipants = $room->max_participants;
        $route = route('rooms.update', $room);
        $requestBody = [
            'max_participants' => $oldParticipants + 1
        ];

        // Act
        $response = $this->actingAs($user)->put($route, $requestBody);

        // Assert
        $response->assertForbidden();
    }

    public function test_that_room_is_not_updated_if_invalid_data(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $user->assignRole('content moderator');
        $room = Room::factory()->create();

        $route = route('rooms.update', $room);
        $requestBody = [
            'max_participants' => -1
        ];
        $roomsOldCount = Room::count();

        // Act
        $response = $this->actingAs($user)->put($route, $requestBody);

        // Assert
        $response->assertSessionHasErrors(['max_participants']);
    }

    public function test_that_room_can_be_deleted_if_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'content moderator']);
        $room = Room::factory()->create();
        $route = route('rooms.destroy', $room);
        $oldRoomCount = Room::count();

        $user->assignRole('content moderator');

        // Act
        $response = $this->actingAs($user)->delete($route);

        // Assert
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('rooms.index'));

        $this->assertDatabaseCount('rooms', $oldRoomCount - 1);
    }

    public function test_that_room_cannot_be_deleted_if_not_moderator(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::create(['name' => 'participant']);
        $room = Room::factory()->create();
        $route = route('rooms.destroy', $room);
        $oldRoomCount = Room::count();

        $user->assignRole('participant');

        // Act
        $response = $this->actingAs($user)->delete($route);

        // Assert
        $response->assertForbidden();
        $this->assertDatabaseCount('rooms', $oldRoomCount);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Booth;
use App\Models\Company;
use App\Models\Room;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RoomControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('app:sync-permissions');
    }

    /** @test */
    public function index_displays_rooms_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.rooms.index'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.rooms.index');
        $response->assertViewHas('rooms');
    }

    /** @test */
    public function index_denies_participant_access_to_rooms()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.rooms.index'));

        $response->assertStatus(403);
    }


    /** @test */
    public function create_displays_view_to_rooms()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.rooms.create'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.rooms.create');
    }

    /** @test */
    public function create_denies_access_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.rooms.create'));

        $response->assertStatus(403);
    }

    /** @test */
    public function store_saves_and_redirects_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');
        $data = [
            'name' => "Random",
            'max_participants' => 10,
        ];

        $response = $this->actingAs($user)->post(route('moderator.rooms.store'), $data);

        $response->assertRedirect(route('moderator.rooms.index'));
        $this->assertDatabaseHas('rooms', $data);
    }

    /** @test */
    public function store_denies_action_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');
        $company = Company::factory()->create();
        $data = [
            'name' => "Random",
            'max_participants' => 10,
        ];

        $response = $this->actingAs($user)->post(route('moderator.rooms.store'), $data);

        $response->assertStatus(403);
        $this->assertNull($company->booth);
    }

    /** @test */
    public function show_displays_correct_room_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');
        $room = Room::factory()->create();
        $response = $this->actingAs($user)->get(route('moderator.rooms.show', $room));

        $response->assertStatus(200);
        $response->assertViewIs('crew.rooms.show');
        $response->assertViewHas('room', $room);
    }

    /** @test */
    public function show_denies_access_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');
        $room = Room::factory()->create();
        $response = $this->actingAs($user)->get(route('moderator.rooms.show', $room));

        $response->assertStatus(403);
    }

    /** @test */
    public function destroy_deletes_and_redirects_to_crew()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $roomCount = Room::all()->count();
        $user->assignRole('event organizer');

        $response = $this->actingAs($user)->delete(route('moderator.rooms.destroy', $room));

        $response->assertRedirect(route('moderator.rooms.index'));
        $this->assertEquals(Room::all()->count() + 1, $roomCount);
    }

    /** @test */
    public function destroy_denies_action_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');
        $room = Room::factory()->create();
        $roomCount = Room::all()->count();

        $response = $this->actingAs($user)->delete(route('moderator.rooms.destroy', $room));

        $response->assertStatus(403);
        $this->assertEquals(Room::all()->count(), $roomCount);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Booth;
use App\Models\Company;
use App\Models\Edition;
use App\Models\EditionEvent;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BoothControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
        Edition::create([
            'name' => 'test',
            'state' => Edition::STATE_ANNOUNCE,
            'start_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 17:00:00')),
        ]);
    }

    /** @test */
    public function index_displays_booths_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.booths.index'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.booths.index');
        $response->assertViewHas('booths');
    }

    /** @test */
    public function index_denies_participant_access_to_booths()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.booths.index'));

        $response->assertStatus(403);
    }


    /** @test */
    public function create_displays_view_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.booths.create'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.booths.create');
    }

    /** @test */
    public function create_denies_access_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.booths.create'));

        $response->assertStatus(403);
    }

    /** @test */
    public function store_saves_and_redirects_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');
        $company = Company::factory()->create();
        $data = [
            'company_id' => $company->id,
            'width' => 10,
            'length' => 20,
            'additional_information' => 'Sample info'
        ];

        $response = $this->actingAs($user)->post(route('moderator.booths.store'), $data);

        $response->assertRedirect(route('moderator.booths.index'));
        $this->assertDatabaseHas('booths', $data);
    }

    /** @test */
    public function store_denies_action_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');
        $company = Company::factory()->create();
        $data = [
            'company_id' => $company->id,
            'width' => 10,
            'length' => 20,
            'additional_information' => 'Sample info'
        ];

        $response = $this->actingAs($user)->post(route('moderator.booths.store'), $data);

        $response->assertStatus(403);
        $this->assertNull($company->booth);
    }

    /** @test */
    public function show_displays_correct_booth_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');
        $company = Company::factory()->has(Booth::factory(1))->create();

        $response = $this->actingAs($user)->get(route('moderator.booths.show', $company->booth));

        $response->assertStatus(200);
        $response->assertViewIs('crew.booths.show');
        $response->assertViewHas('booth', $company->booth);
    }

    /** @test */
    public function show_denies_access_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');
        $company = Company::factory()->has(Booth::factory(1))->create();

        $response = $this->actingAs($user)->get(route('moderator.booths.show', $company->booth));

        $response->assertStatus(403);
    }

    /** @test */
    public function approve_updates_booth_and_redirects_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');
        $company = Company::factory()->has(Booth::factory(1))->has(User::factory(1)->afterCreating(function ($user) {
            $role = Role::findByName('company representative');
            $user->assignRole($role);
        }))->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.booths.approve', [$company->booth, 'approved' => true]));

        $response->assertRedirect(route('moderator.booths.show', ['booth' => $company->booth]));
        $company->refresh();
        $this->assertEquals(1, $company->booth->is_approved);
    }

    /** @test */
    public function approve_denies_action_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');
        $company = Company::factory()->has(Booth::factory(1))->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.booths.approve', [$company->booth, 'approved' => true]));

        $response->assertStatus(403);
        $this->assertEquals(0, $company->booth->is_approved);
    }

    /** @test */
    public function destroy_deletes_and_redirects_to_crew()
    {
        $user = User::factory()->create();
        $user->assignRole('event organizer');
        $company = Company::factory()->has(Booth::factory(1))->create();
        $boothCount = Booth::all()->count();

        $response = $this->actingAs($user)->delete(route('moderator.booths.destroy', $company->booth));

        $response->assertRedirect(route('moderator.booths.index'));
        $this->assertEquals(Booth::all()->count() + 1, $boothCount);
    }

    /** @test */
    public function destroy_denies_action_to_participant()
    {
        $user = User::factory()->create();
        $user->assignRole('participant');
        $company = Company::factory()->has(Booth::factory(1))->create();
        $boothCount = Booth::all()->count();

        $response = $this->actingAs($user)->delete(route('moderator.booths.destroy', $company->booth));

        $response->assertStatus(403);
        $this->assertEquals(Booth::all()->count(), $boothCount);
    }
}

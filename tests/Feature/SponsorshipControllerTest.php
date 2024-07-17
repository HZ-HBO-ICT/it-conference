<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Edition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SponsorshipControllerTest extends TestCase
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
    public function event_organizer_can_view_sponsorships_index()
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.sponsorships.index'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.sponsorships.index');
        $response->assertViewHas('companies');
    }

    /** @test */
    public function user_cannot_view_sponsorships_index_without_permission()
    {
        $user = User::factory()->create()->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.sponsorships.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function event_organizer_can_access_create_sponsorship_form()
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.sponsorships.create'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.sponsorships.create');
        $response->assertViewHas('companies');
        $response->assertViewHas('tiers');
    }

    /** @test */
    public function user_cannot_access_create_sponsorship_form_without_permission()
    {
        $user = User::factory()->create()->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.sponsorships.create'));

        $response->assertStatus(403);
    }

    /** @test */
    public function event_organizer_can_store_sponsorship()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()->create(['is_approved' => true]);

        $data = [
            'company_id' => $company->id,
            'sponsorship_id' => 3,
        ];

        $response = $this->actingAs($user)->post(route('moderator.sponsorships.store'), $data);

        $response->assertRedirect(route('moderator.sponsorships.show', $company));
        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'sponsorship_id' => $data['sponsorship_id'],
            'is_sponsorship_approved' => 1,
        ]);
    }

    /** @test */
    public function event_organizer_can_view_sponsorship()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()->create(['sponsorship_id' => 1]);

        $response = $this->actingAs($user)->get(route('moderator.sponsorships.show', $company));

        $response->assertStatus(200);
        $response->assertViewIs('crew.sponsorships.show');
        $response->assertViewHas('company', $company);
    }

    /** @test */
    public function user_cannot_show_nonexistent_sponsorship()
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.sponsorships.show', 999));

        $response->assertStatus(404);
    }

    /** @test */
    public function event_organizer_can_approve_sponsorship()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()->has(User::factory(1)->afterCreating(function ($user) {
            $role = Role::findByName('company representative');
            $user->assignRole($role);
        }))->create(['is_approved' => 1,'sponsorship_id' => 1]);

        $response = $this->actingAs($user)
            ->post(route('moderator.sponsorships.approve', $company), ['approved' => true]);

        $response->assertRedirect(route('moderator.sponsorships.show', $company));
        $this->assertEquals(1, $company->refresh()->is_sponsorship_approved);
    }

    /** @test */
    public function event_organizer_can_reject_sponsorship()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()->has(User::factory(1)->afterCreating(function ($user) {
            $role = Role::findByName('company representative');
            $user->assignRole($role);
        }))->create(['sponsorship_id' => 1]);

        $response = $this->actingAs($user)
            ->post(route('moderator.sponsorships.approve', $company), ['approved' => false]);

        $response->assertRedirect(route('moderator.sponsorships.index'));
        $this->assertNull($company->refresh()->is_sponsorship_approved);
    }

    /** @test */
    public function user_cannot_approve_or_reject_sponsorship_without_permission()
    {
        $user = User::factory()->create()->assignRole('participant');
        $company = Company::factory()->create(['sponsorship_id' => 1]);

        $response = $this->actingAs($user)
            ->post(route('moderator.sponsorships.approve', $company), ['approved' => true]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('companies', ['id' => $company->id]);
    }

    /** @test */
    public function event_organizer_can_delete_sponsorship()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()->create(['sponsorship_id' => 1]);

        $response = $this->actingAs($user)->delete(route('moderator.sponsorships.delete', $company));

        $response->assertRedirect(route('moderator.sponsorships.index'));
        $this->assertNull($company->refresh()->sponsorship_id);
    }

    /** @test */
    public function user_cannot_delete_sponsorship_without_permission()
    {
        $user = User::factory()->create()->assignRole('participant');
        $company = Company::factory()->create(['sponsorship_id' => 1]);

        $response = $this->actingAs($user)->delete(route('moderator.sponsorships.delete', $company));

        $response->assertStatus(403);
        $this->assertNotNull($company->refresh()->sponsorship_id);
    }
}

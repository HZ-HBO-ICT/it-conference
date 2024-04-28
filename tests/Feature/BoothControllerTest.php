<?php

namespace Tests\Feature;

use App\Models\Booth;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class BoothControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('admin:upsert-master-data');
    }

    /** @test */
    public function index_displays_booths()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.booths.index'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.booths.index');
        $response->assertViewHas('booths');
    }

    /** @test */
    public function create_displays_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.booths.create'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.booths.create');
    }

    /** @test */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
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
    public function show_displays_correct_booth()
    {
        $user = User::factory()->create();
        $company = Company::factory()->has(Booth::factory(1))->create();

        $response = $this->actingAs($user)->get(route('moderator.booths.show', $company->booth));

        $response->assertStatus(200);
        $response->assertViewIs('crew.booths.show');
        $response->assertViewHas('booth', $company->booth);
    }

    /** @test */
    public function approve_updates_booth_and_redirects()
    {
        $user = User::factory()->create();
        $company = Company::factory()->has(Booth::factory(1))->create();

        $response = $this->actingAs($user)->post(route('moderator.booths.approve', [$company->booth, 'approved' => true]));

        $response->assertRedirect(route('moderator.requests', 'booths'));
        $company->refresh();
        $this->assertEquals(1, $company->booth->is_approved);
    }

    /** @test */
    public function destroy_deletes_and_redirects()
    {
        $user = User::factory()->create();
        $company = Company::factory()->has(Booth::factory(1))->create();
        $boothCount = Booth::all()->count();

        $response = $this->actingAs($user)->delete(route('moderator.booths.destroy', $company->booth));

        $response->assertRedirect(route('moderator.booths.index'));
        $this->assertEquals(Booth::all()->count() + 1, $boothCount);
    }
}

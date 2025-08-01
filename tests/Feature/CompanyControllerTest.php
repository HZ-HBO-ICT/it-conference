<?php

namespace Tests\Feature;

use App\Enums\ApprovalStatus;
use App\Models\Company;
use App\Models\Edition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        activity()->disableLogging();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
        Edition::create([
            'name' => 'test',
            'state' => Edition::STATE_ANNOUNCE,
            'start_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 09:00:00')),
            'end_at' => date('Y-m-d H:i:s', strtotime('2024-11-18 17:00:00')),
        ]);
    }

    #[Test]
    public function event_organizer_can_view_companies_index()
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.companies.index'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.companies.index');
        $response->assertViewHas('companies');
    }

    #[Test]
    public function participant_cannot_view_companies_index()
    {
        $user = User::factory()->create()->assignRole('participant');

        $response = $this->actingAs($user)->get(route('moderator.companies.index'));

        $response->assertStatus(403);
    }

    #[Test]
    public function event_organizer_can_access_create_company_form()
    {
        $user = User::factory()->create()->assignRole('event organizer');

        $response = $this->actingAs($user)->get(route('moderator.companies.create'));

        $response->assertStatus(200);
        $response->assertViewIs('crew.companies.create');
    }

    #[Test]
    public function participant_cannot_access_create_company_form()
    {
        $user = User::factory()->create()->assignRole('participant');
        $response = $this->actingAs($user)->get(route('moderator.companies.create'));
        $response->assertStatus(403);
    }

    #[Test]
    public function event_organizer_can_store_company_with_existing_user()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $representative = User::factory()->create()->assignRole('participant');
        $companyData = [
            'name' => 'Test Company',
            'description' => 'Lorem ipsum',
            'website' => 'www.github.com',
            'postcode' => '1234AB',
            'house_number' => '3',
            'phone_number' => '+31588323885',
            'street' => 'Example street',
            'city' => 'Example city',
            'rep_email' => $representative->email,
            'rep_new_email' => ''
        ];

        $response = $this->actingAs($user)->post(route('moderator.companies.store'), $companyData);

        $response->assertRedirect(route('moderator.companies.index'));
        $this->assertDatabaseHas('companies', ['name' => $companyData['name']]);
    }

    #[Test]
    public function event_organizer_can_store_company_with_new_user()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $representative = User::factory()->create()->assignRole('participant');
        $companyData = [
            'name' => 'Test Company',
            'description' => 'Lorem ipsum',
            'website' => 'www.github.com',
            'postcode' => '1234AB',
            'house_number' => '3',
            'phone_number' => '+31588323885',
            'street' => 'Example street',
            'city' => 'Example city',
            'rep_email' => $representative->email,
            'rep_new_email' => 'newest.user@gmail.com'
        ];

        $response = $this->actingAs($user)->post(route('moderator.companies.store'), $companyData);

        $response->assertRedirect(route('moderator.companies.index'));
        $this->assertDatabaseHas('companies', ['name' => $companyData['name']]);
    }

    #[Test]
    public function participant_cannot_store_company()
    {
        $companyCount = Company::count();
        $user = User::factory()->create()->assignRole('participant');
        $representative = User::factory()->create()->assignRole('participant');
        $companyData = [
            'name' => 'Test Company',
            'description' => 'Lorem ipsum',
            'website' => 'https://github.com/HZ-HBO-ICT/it-conference',
            'postcode' => '1234AB',
            'house_number' => '3',
            'phone_number' => '+31588323885',
            'street' => 'Example street',
            'city' => 'Example city',
            'rep_email' => $representative->email
        ];

        $response = $this->actingAs($user)->post(route('moderator.companies.store'), $companyData);

        $response->assertStatus(403);
        $this->assertEquals($companyCount, Company::count());
    }

    #[Test]
    public function event_organizer_receives_validation_errors_on_invalid_company_data()
    {
        $companyCount = Company::count();
        $user = User::factory()->create()->assignRole('event organizer');
        $rep = User::factory()->create()->assignRole('participant');

        $invalidCompanyData = [
            'name' => '',
            'description' => '',
            'website' => 'not-a-url',
            'postcode' => '123',
            'house_number' => '',
            'phone_number' => 'invalid-phone',
            'street' => '',
            'city' => '',
            'rep_email' => $rep->email
        ];

        $response = $this->actingAs($user)->post(route('moderator.companies.store'), $invalidCompanyData);

        $response->assertSessionHasErrors([
            'name', 'description', 'website', 'house_number', 'phone_number', 'street', 'city'
        ]);

        $this->assertEquals($companyCount, Company::count());
    }

    #[Test]
    public function event_organizer_can_view_company_details()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.companies.show', $company));

        $response->assertStatus(200);
        $response->assertViewIs('crew.companies.show');
        $response->assertViewHas('company', $company);
    }

    #[Test]
    public function participant_cannot_view_company_details()
    {
        $user = User::factory()->create()->assignRole('participant');
        $company = Company::factory()->create();

        $response = $this->actingAs($user)->get(route('moderator.companies.show', $company));

        $response->assertStatus(403);
    }

    #[Test]
    public function event_organizer_can_approve_company()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()
            ->setApprovalStatus(ApprovalStatus::AWAITING_APPROVAL->value)
            ->has(User::factory(1)
            ->afterCreating(function ($user) {
                $role = Role::findByName('company representative');
                $user->assignRole($role);
            }))->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.companies.approve', ['company' => $company, 'isApproved' => 1]));

        $response->assertRedirect(route('moderator.companies.show', $company));
        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'approval_status' => ApprovalStatus::APPROVED->value
        ]);
    }

    #[Test]
    public function event_organizer_can_reject_company()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()
            ->setApprovalStatus(ApprovalStatus::AWAITING_APPROVAL->value)
            ->has(User::factory(1)
            ->afterCreating(function ($user) {
                $role = Role::findByName('company representative');
                $user->assignRole($role);
            }))->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.companies.approve', ['company' => $company, 'isApproved' => 0]));

        $response->assertRedirect(route('moderator.companies.index'));
        $this->assertDatabaseMissing('companies', ['name' => $company->name]);
    }

    #[Test]
    public function participant_cannot_approve_or_reject_company()
    {
        $user = User::factory()->create()->assignRole('participant');
        $company = Company::factory()->setApprovalStatus(ApprovalStatus::AWAITING_APPROVAL->value)->create();

        $response = $this->actingAs($user)
            ->post(route('moderator.companies.approve', ['company' => $company, 'isApproved' => true]));

        $company->refresh();
        $response->assertStatus(403);
        $this->assertEquals(ApprovalStatus::AWAITING_APPROVAL->value, $company->approval_status);
    }

    #[Test]
    public function event_organizer_can_delete_company()
    {
        $user = User::factory()->create()->assignRole('event organizer');
        $company = Company::factory()->create();

        $response = $this->actingAs($user)->delete(route('moderator.companies.destroy', $company));

        $response->assertRedirect(route('moderator.companies.index'));
        $this->assertDatabaseMissing('companies', [
            'id' => $company->id
        ]);
    }

    #[Test]
    public function participant_cannot_delete_company()
    {
        $user = User::factory()->create()->assignRole('participant');
        $company = Company::factory()->create();

        $response = $this->actingAs($user)->delete(route('moderator.companies.destroy', $company));

        $response->assertStatus(403);
        $this->assertDatabaseHas('companies', ['name' => $company->name]);
    }
}

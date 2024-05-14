<?php

namespace Tests\Unit;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CreateNewUserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_user_is_created_successfully()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'PassworDD@123!!',
            'password_confirmation' => 'PassworDD@123!!',
            'institution' => "HZ University of Applied Sciences",
            'terms' => 'on',
        ];
        $action = new CreateNewUser();

        $user = $action->create($data);

        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('participant'));
        $this->assertEquals($user->email, $data['email']);
    }

    public function test_company_is_created_with_user()
    {
        $action = new CreateNewUser();

        $user = $action->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'PassworDD@123!!',
            'password_confirmation' => 'PassworDD@123!!',
            'terms' => 'on',
            'company_name' => 'Example Company',
            'company_description' => 'An example company.',
            'company_website' => 'https://example.com',
            'company_postcode' => '1234AB',
            'company_house_number' => '1A',
            'company_phone_number' => '0888888888',
            'company_street' => 'Example Street',
            'company_city' => 'Example City',
        ]);

        $this->assertNotNull($user->company);
        $this->assertEquals('Example Company', $user->company->name);
    }


    public function test_validation_fails_with_missing_fields()
    {
        $this->expectException(ValidationException::class);

        $action = new CreateNewUser();

        $action->create([]);
    }
}

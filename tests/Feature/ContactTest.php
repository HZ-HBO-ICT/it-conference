<?php

namespace Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\ContactUs;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        activity()->disableLogging();
        Artisan::call('admin:upsert-master-data');
        Artisan::call('admin:sync-permissions');
    }

    /** @test */
    public function test_that_user_successfully_sends_a_question(): void
    {
        # Arrange
        Mail::fake();

        $data = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'subject' => 'Program Inquiry',
            'message' => 'I have a question about the program.',
        ];

        # Act
        $response = $this->post(route('contact.send'), $data);

        # Assert
        $response->assertRedirect(); // Ensure it redirects after submission
        $response->assertSessionHas('success', 'Thank you for your message. We will get back to you soon.');

        Mail::assertSent(ContactUs::class);
    }

    /** @test */
    public function test_that_it_requires_all_fields_to_be_filled(): void
    {
        # Act
        $response = $this->post(route('contact.send'));

        # Assert
        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    /** @test */
    public function test_that_email_field_must_be_valid(): void
    {
        # Arrange
        $data = [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'subject' => 'Booth Inquiry',
            'message' => 'How much does it cost to set up a booth?',
        ];

        # Act
        $response = $this->post(route('contact.send'), $data);

        # Assert
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function test_that_subject_must_be_from_allowed_options(): void
    {
        # Arrange
        $data = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'subject' => '',
            'message' => 'Hello, I have a question.',
        ];

        # Act
        $response = $this->post(route('contact.send'), $data);

        # Assert
        $response->assertSessionHasErrors('subject');
    }
}

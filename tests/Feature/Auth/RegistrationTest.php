<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\RoleSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_students_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'student',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
        
        $user = \App\Models\User::where('email', 'student@example.com')->first();
        $this->assertTrue($user->hasRole('student'));
        $this->assertNull($user->alumniProfile);
    }

    public function test_new_alumni_can_register_with_profile(): void
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->post('/register', [
            'name' => 'Test Alumni',
            'email' => 'alumni@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'alumni',
            'graduation_year' => 2020,
            'department' => 'CS',
            'verification_document' => $file,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));

        $user = \App\Models\User::where('email', 'alumni@example.com')->first();
        $this->assertTrue($user->hasRole('alumni'));
        $this->assertNotNull($user->alumniProfile);
        $this->assertEquals(2020, $user->alumniProfile->graduation_year);
    }
}

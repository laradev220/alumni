<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_alumni_can_access_and_create_events(): void
    {
        $user = User::factory()->create();
        $user->assignRole('alumni');

        $response = $this->actingAs($user)->get('/events/create');

        $response->assertOk();

        $storeResponse = $this->actingAs($user)->post('/events', [
            'title' => 'Alumni Meetup',
            'description' => 'Annual alumni networking session.',
            'date' => now()->addDay()->format('Y-m-d H:i:s'),
            'location_type' => 'physical',
            'location_details' => 'Main Hall',
            'zoom_link' => null,
        ]);

        $storeResponse
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('events.index', absolute: false));

        $this->assertDatabaseHas('events', [
            'title' => 'Alumni Meetup',
            'creator_id' => $user->id,
        ]);
    }

    public function test_admin_can_delete_any_event(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $creator = User::factory()->create();
        $creator->assignRole('alumni');

        $event = Event::create([
            'title' => 'Reunion Night',
            'description' => 'A community gathering for alumni.',
            'date' => now()->addWeek(),
            'location_type' => 'virtual',
            'location_details' => null,
            'zoom_link' => 'https://example.com/zoom',
            'creator_id' => $creator->id,
        ]);

        $response = $this->actingAs($admin)->delete(route('events.destroy', $event));

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('events.index', absolute: false));

        $this->assertDatabaseMissing('events', [
            'id' => $event->id,
        ]);
    }

    public function test_student_cannot_access_event_creation(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $this->actingAs($user)
            ->get('/events/create')
            ->assertForbidden();

        $this->actingAs($user)
            ->post('/events', [
                'title' => 'Blocked Event',
                'description' => 'Students should not create events.',
                'date' => now()->addDay()->format('Y-m-d H:i:s'),
                'location_type' => 'physical',
                'location_details' => 'Auditorium',
                'zoom_link' => null,
            ])
            ->assertForbidden();
    }

    public function test_student_cannot_delete_events(): void
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $creator = User::factory()->create();
        $creator->assignRole('alumni');

        $event = Event::create([
            'title' => 'Private Alumni Session',
            'description' => 'A restricted event for alumni organizers.',
            'date' => now()->addWeek(),
            'location_type' => 'physical',
            'location_details' => 'Conference Room',
            'zoom_link' => null,
            'creator_id' => $creator->id,
        ]);

        $this->actingAs($student)
            ->delete(route('events.destroy', $event))
            ->assertForbidden();
    }
}

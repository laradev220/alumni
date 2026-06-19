<?php

namespace Tests\Feature;

use App\Livewire\Events\RsvpButton;
use App\Models\Event;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EventRsvpTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_authenticated_user_can_toggle_rsvp_statuses(): void
    {
        $user = User::factory()->create();
        $user->assignRole('student');

        $creator = User::factory()->create();
        $creator->assignRole('alumni');

        $event = Event::create([
            'title' => 'Career Night',
            'description' => 'A session for alumni and students.',
            'date' => now()->addWeek(),
            'location_type' => 'physical',
            'location_details' => 'Auditorium',
            'zoom_link' => null,
            'creator_id' => $creator->id,
        ]);

        $this->actingAs($user);

        Livewire::test(RsvpButton::class, ['eventId' => $event->id])
            ->call('setStatus', 'going')
            ->assertSet('currentStatus', 'going')
            ->assertSet('goingCount', 1)
            ->assertSet('interestedCount', 0)
            ->assertSet('totalCount', 1);

        $this->assertDatabaseHas('rsvps', [
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => 'going',
        ]);

        Livewire::test(RsvpButton::class, ['eventId' => $event->id])
            ->call('setStatus', 'interested')
            ->assertSet('currentStatus', 'interested')
            ->assertSet('goingCount', 0)
            ->assertSet('interestedCount', 1)
            ->assertSet('totalCount', 1);

        $this->assertDatabaseHas('rsvps', [
            'event_id' => $event->id,
            'user_id' => $user->id,
            'status' => 'interested',
        ]);

        Livewire::test(RsvpButton::class, ['eventId' => $event->id])
            ->call('clearStatus')
            ->assertSet('currentStatus', null)
            ->assertSet('goingCount', 0)
            ->assertSet('interestedCount', 0)
            ->assertSet('totalCount', 0);

        $this->assertDatabaseMissing('rsvps', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_event_show_page_displays_rsvp_summary(): void
    {
        $goingUser = User::factory()->create();
        $goingUser->assignRole('student');

        $interestedUser = User::factory()->create();
        $interestedUser->assignRole('student');

        $creator = User::factory()->create();
        $creator->assignRole('alumni');

        $event = Event::create([
            'title' => 'Mentor Meetup',
            'description' => 'An event with mixed RSVP states.',
            'date' => now()->addWeek(),
            'location_type' => 'virtual',
            'location_details' => null,
            'zoom_link' => 'https://example.com/meet',
            'creator_id' => $creator->id,
        ]);

        $this->actingAs($goingUser);
        Livewire::test(RsvpButton::class, ['eventId' => $event->id])
            ->call('setStatus', 'going');

        $this->actingAs($interestedUser);
        Livewire::test(RsvpButton::class, ['eventId' => $event->id])
            ->call('setStatus', 'interested');

        $this->actingAs($goingUser)
            ->get(route('events.show', $event))
            ->assertOk()
            ->assertSeeText('1 going')
            ->assertSeeText('1 interested')
            ->assertSeeText('2 total responses');
    }
}

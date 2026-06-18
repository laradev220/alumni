<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class RsvpButton extends Component
{
    public $eventId;
    public $attending = false;
    public $attendingCount = 0;

    public function mount($eventId): void
    {
        $this->eventId = $eventId;
        $this->checkStatus();
    }

    protected function checkStatus(): void
    {
        if (auth()->check()) {
            $event = Event::findOrFail($this->eventId);
            $this->attending = $event->attendees()
                ->where('user_id', auth()->id())
                ->exists();
        }

        $this->attendingCount = Event::findOrFail($this->eventId)
            ->attendees()
            ->count();
    }

    public function toggle(): void
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $event = Event::findOrFail($this->eventId);

        if ($this->attending) {
            $event->attendees()->detach(auth()->id());
            $this->attending = false;
        } else {
            $event->attendees()->attach(auth()->id(), ['status' => 'going']);
            $this->attending = true;
        }

        $this->attendingCount = $event->attendees()->count();
        $this->dispatch('rsvpUpdated');
    }

    public function render()
    {
        return view('livewire.events.rsvp-button');
    }
}

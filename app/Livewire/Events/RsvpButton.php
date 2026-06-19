<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class RsvpButton extends Component
{
    public $eventId;
    public $currentStatus = null;
    public $goingCount = 0;
    public $interestedCount = 0;
    public $totalCount = 0;

    public function mount($eventId): void
    {
        $this->eventId = $eventId;
        $this->checkStatus();
    }

    protected function checkStatus(): void
    {
        $event = Event::findOrFail($this->eventId);

        if (auth()->check()) {
            $this->currentStatus = $event->attendees()
                ->where('user_id', auth()->id())
                ->first()?->pivot?->status;
        }

        $this->refreshCounts($event);
    }

    protected function refreshCounts(?Event $event = null): void
    {
        $event ??= Event::findOrFail($this->eventId);

        $this->goingCount = $event->attendees()
            ->wherePivot('status', 'going')
            ->count();

        $this->interestedCount = $event->attendees()
            ->wherePivot('status', 'interested')
            ->count();

        $this->totalCount = $this->goingCount + $this->interestedCount;
    }

    public function setStatus(string $status)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (! in_array($status, ['going', 'interested'], true)) {
            abort(422, 'Invalid RSVP status.');
        }

        $event = Event::findOrFail($this->eventId);
        $existingStatus = $event->attendees()
            ->where('user_id', auth()->id())
            ->first()?->pivot?->status;

        if ($existingStatus === $status) {
            $event->attendees()->detach(auth()->id());
        } else {
            $event->attendees()->syncWithoutDetaching([
                auth()->id() => ['status' => $status],
            ]);
        }

        $this->currentStatus = $existingStatus === $status ? null : $status;
        $this->refreshCounts($event);
        $this->dispatch('rsvpUpdated');
    }

    public function clearStatus()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $event = Event::findOrFail($this->eventId);
        $event->attendees()->detach(auth()->id());

        $this->currentStatus = null;
        $this->refreshCounts($event);
        $this->dispatch('rsvpUpdated');
    }

    public function render()
    {
        return view('livewire.events.rsvp-button');
    }
}

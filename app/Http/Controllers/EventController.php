<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    private function ensureEventManagementAccess(): void
    {
        $user = auth()->user();

        if (! $user || (! $user->isAlumni() && ! $user->isAdmin())) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Display a listing of upcoming events.
     */
    public function index(): View
    {
        $events = Event::with('creator')
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->paginate(12);

        $pastEvents = Event::with('creator')
            ->where('date', '<', now())
            ->orderBy('date', 'desc')
            ->limit(6)
            ->get();

        return view('events.index', compact('events', 'pastEvents'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create(): View
    {
        $this->ensureEventManagementAccess();

        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->ensureEventManagementAccess();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'date' => ['required', 'date', 'after:now'],
            'location_type' => ['required', 'in:virtual,physical'],
            'location_details' => ['nullable', 'string', 'max:255'],
            'zoom_link' => ['nullable', 'url', 'max:255'],
        ]);

        Event::create([
            ...$validated,
            'creator_id' => auth()->id(),
        ]);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event): View
    {
        $event->load(['creator', 'attendees']);

        $goingCount = $event->attendees()
            ->wherePivot('status', 'going')
            ->count();

        $interestedCount = $event->attendees()
            ->wherePivot('status', 'interested')
            ->count();

        $responseCount = $goingCount + $interestedCount;

        return view('events.show', compact('event', 'goingCount', 'interestedCount', 'responseCount'));
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $user = auth()->user();

        if (! $user || ($event->creator_id !== $user->id && ! $user->isAdmin())) {
            abort(403, 'Unauthorized action.');
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }
}

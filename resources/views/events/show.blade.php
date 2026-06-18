<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $event->title }}
            </h2>
            @if(auth()->id() === $event->creator_id || auth()->user()->isAdmin())
                <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Event Meta -->
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <div class="flex items-center text-sm text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event->date->format('l, M d, Y \a\t g:i A') }}
                        </div>

                        @if($event->location_type === 'virtual')
                            <span class="inline-flex items-center text-sm text-green-700 bg-green-50 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                Virtual
                            </span>
                        @else
                            <span class="inline-flex items-center text-sm text-purple-700 bg-purple-50 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                In-Person
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="prose prose-indigo max-w-none mb-8">
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $event->description }}</p>
                    </div>

                    <!-- Location Details -->
                    @if($event->location_details || $event->zoom_link)
                        <div class="bg-gray-50 rounded-lg p-4 mb-8">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Location</h3>
                            @if($event->location_details)
                                <p class="text-sm text-gray-600">{{ $event->location_details }}</p>
                            @endif
                            @if($event->zoom_link)
                                <a href="{{ $event->zoom_link }}" target="_blank" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-900 mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Join Meeting
                                </a>
                            @endif
                        </div>
                    @endif

                    <!-- RSVP Section -->
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Attendance</h3>
                        </div>

                        @auth
                            @livewire('events.rsvp-button', ['eventId' => $event->id])
                        @else
                            <p class="text-sm text-gray-600">
                                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Log in</a>
                                to RSVP for this event.
                            </p>
                        @endauth
                    </div>

                    <!-- Attendees List -->
                    @if($attendingCount > 0)
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">Attendees ({{ $attendingCount }})</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($event->attendees->take(20) as $attendee)
                                    <div class="inline-flex items-center bg-gray-100 rounded-full px-3 py-1 text-sm">
                                        <span class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-medium text-indigo-600 mr-2">
                                            {{ substr($attendee->name, 0, 1) }}
                                        </span>
                                        {{ $attendee->name }}
                                    </div>
                                @endforeach
                                @if($attendingCount > 20)
                                    <span class="inline-flex items-center text-sm text-gray-500 px-3 py-1">
                                        +{{ $attendingCount - 20 }} more
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Event Creator -->
                    <div class="border-t border-gray-200 pt-6">
                        <p class="text-sm text-gray-500">
                            Created by <span class="font-medium text-gray-700">{{ $event->creator->name }}</span>
                            · {{ $event->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

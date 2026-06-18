<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-indigo-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Welcome, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm text-gray-500">
                                @if(Auth::user()->hasRole('alumni'))
                                    Alumni · {{ Auth::user()->alumniProfile?->department ?? 'Alumni' }}
                                @elseif(Auth::user()->hasRole('student'))
                                    Student
                                @elseif(Auth::user()->hasRole('admin'))
                                    Administrator
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $alumniCount }}</p>
                                <p class="text-sm text-gray-500">Alumni</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $upcomingEvents }}</p>
                                <p class="text-sm text-gray-500">Upcoming Events</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $jobCount }}</p>
                                <p class="text-sm text-gray-500">Jobs Posted</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                        <div class="space-y-3">
                            <a href="{{ route('alumni.directory') }}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">Browse Alumni Directory</span>
                            </a>
                            <a href="{{ route('events.index') }}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">View Events</span>
                            </a>
                            @if(Auth::user()->hasRole('alumni'))
                                <a href="{{ route('alumni.profile.edit') }}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 transition group">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">Edit My Profile</span>
                                </a>
                            @endif
                            <a href="{{ route('events.create') }}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 transition group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">Create Event</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Upcoming Events</h3>
                            <a href="{{ route('events.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">View All</a>
                        </div>
                        @if($events->count() > 0)
                            <div class="space-y-4">
                                @foreach($events as $event)
                                    <div class="flex items-start gap-3 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex flex-col items-center justify-center shrink-0">
                                            <span class="text-xs font-bold text-indigo-600 leading-none">{{ $event->date->format('M') }}</span>
                                            <span class="text-lg font-bold text-indigo-600 leading-none">{{ $event->date->format('d') }}</span>
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('events.show', $event) }}" class="text-sm font-medium text-gray-900 hover:text-indigo-600 transition">
                                                {{ $event->title }}
                                            </a>
                                            <p class="text-xs text-gray-500 mt-0.5">
                                                {{ $event->date->format('g:i A') }} · {{ $event->location_type === 'virtual' ? 'Virtual' : $event->location_details }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 text-center py-6">No upcoming events. Create one!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

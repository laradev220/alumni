<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Alumni Directory</h2>
                    <p class="mt-1 text-sm text-gray-600">Connect with fellow alumni</p>
                </div>

                <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                        <input
                            type="text"
                            id="search"
                            wire:model.live="search"
                            placeholder="Name, job, or bio..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>

                    <div>
                        <label for="yearFilter" class="block text-sm font-medium text-gray-700">Graduation Year</label>
                        <select
                            id="yearFilter"
                            wire:model.live="yearFilter"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            <option value="">All Years</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="departmentFilter" class="block text-sm font-medium text-gray-700">Department</label>
                        <select
                            id="departmentFilter"
                            wire:model.live="departmentFilter"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{ $department }}">{{ $department }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="cityFilter" class="block text-sm font-medium text-gray-700">City</label>
                        <input
                            type="text"
                            id="cityFilter"
                            wire:model.live="cityFilter"
                            placeholder="Filter by city..."
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>
                </div>

                <div class="mb-4">
                    <button
                        wire:click="resetFilters"
                        class="text-sm text-indigo-600 hover:text-indigo-900"
                    >
                        Reset Filters
                    </button>
                </div>

                @if($alumni->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($alumni as $profile)
                            <div class="bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow p-6">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if($profile->profile_photo_url)
                                            <img
                                                src="{{ Storage::url($profile->profile_photo_url) }}"
                                                alt="{{ $profile->full_name }}"
                                                class="h-16 w-16 rounded-full object-cover"
                                            >
                                        @else
                                            <div class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <span class="text-2xl font-bold text-indigo-600">
                                                    {{ substr($profile->full_name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-semibold text-gray-900 truncate">
                                            {{ $profile->full_name }}
                                        </h3>
                                        <p class="text-sm text-gray-600 truncate">
                                            {{ $profile->current_job ?? 'Not specified' }}
                                        </p>
                                        @if($profile->city)
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ $profile->city }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                @if($profile->department || $profile->graduation_year)
                                    <div class="mt-4 flex items-center text-sm text-gray-500">
                                        @if($profile->department)
                                            <span class="mr-3">{{ $profile->department }}</span>
                                        @endif
                                        @if($profile->graduation_year)
                                            <span>Class of {{ $profile->graduation_year }}</span>
                                        @endif
                                    </div>
                                @endif

                                @if($profile->linkedin_url)
                                    <div class="mt-4">
                                        <a
                                            href="{{ $profile->linkedin_url }}"
                                            target="_blank"
                                            class="text-sm text-indigo-600 hover:text-indigo-900"
                                        >
                                            LinkedIn Profile
                                        </a>
                                    </div>
                                @endif

                                <div class="mt-4 flex space-x-2">
                                    <a
                                        href="{{ route('alumni.profile', $profile->user_id) }}"
                                        class="flex-1 text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                                    >
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $alumni->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No alumni found</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if($search || $yearFilter || $departmentFilter || $cityFilter)
                                Try adjusting your filters.
                            @else
                                No verified alumni profiles yet.
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

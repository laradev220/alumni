<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @if($profile && $user)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center space-x-6 mb-6">
                        <div class="flex-shrink-0">
                            @if($profile->profile_photo_url)
                                <img
                                    src="{{ Storage::url($profile->profile_photo_url) }}"
                                    alt="{{ $profile->full_name }}"
                                    class="h-32 w-32 rounded-full object-cover"
                                >
                            @else
                                <div class="h-32 w-32 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-4xl font-bold text-indigo-600">
                                        {{ substr($profile->full_name, 0, 1) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $profile->full_name }}</h2>
                            <p class="text-lg text-gray-600">{{ $profile->current_job ?? 'Not specified' }}</p>
                            @if($profile->city)
                                <p class="text-gray-500">{{ $profile->city }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Graduation Year</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($profile->graduation_year)
                                        Class of {{ $profile->graduation_year }}
                                    @else
                                        Not specified
                                    @endif
                                </dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Department</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($profile->department)
                                        {{ $profile->department }}
                                    @else
                                        Not specified
                                    @endif
                                </dd>
                            </div>

                            @if($profile->linkedin_url)
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">LinkedIn</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <a
                                            href="{{ $profile->linkedin_url }}"
                                            target="_blank"
                                            class="text-indigo-600 hover:text-indigo-900"
                                        >
                                            View Profile
                                        </a>
                                    </dd>
                                </div>
                            @endif

                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Bio</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if($profile->bio)
                                        {{ $profile->bio }}
                                    @else
                                        No bio provided.
                                    @endif
                                </dd>
                            </div>

                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->email }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        @auth
                            @if(auth()->id() !== $userId)
                                <button
                                    class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700"
                                >
                                    Send Message
                                </button>
                                <button
                                    class="px-4 py-2 border border-gray-300 rounded-md font-medium text-sm text-gray-700 hover:bg-gray-50"
                                >
                                    Request Mentorship
                                </button>
                            @else
                                <a
                                    href="{{ route('profile.edit') }}"
                                    class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700"
                                >
                                    Edit Profile
                                </a>
                            @endif
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700"
                            >
                                Login to Connect
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Profile not found</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            This alumni profile may not exist or is not verified yet.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

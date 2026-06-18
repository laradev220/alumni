<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf

                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Event Title *</label>
                                <input
                                    id="title"
                                    type="text"
                                    name="title"
                                    value="{{ old('title') }}"
                                    required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="e.g., Annual Alumni Meetup 2026"
                                >
                                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Tell attendees what this event is about..."
                                >{{ old('description') }}</textarea>
                                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Date & Time -->
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Date & Time *</label>
                                <input
                                    id="date"
                                    type="datetime-local"
                                    name="date"
                                    value="{{ old('date') }}"
                                    required
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                >
                                @error('date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Location Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location Type *</label>
                                <div class="mt-2 space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="location_type" value="virtual" {{ old('location_type') === 'virtual' ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">Virtual (Online)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="location_type" value="physical" {{ old('location_type') === 'physical' ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">Physical (In-Person)</span>
                                    </label>
                                </div>
                                @error('location_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Location Details -->
                            <div>
                                <label for="location_details" class="block text-sm font-medium text-gray-700">Location Details</label>
                                <input
                                    id="location_details"
                                    type="text"
                                    name="location_details"
                                    value="{{ old('location_details') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="e.g., Main Auditorium, Building A"
                                >
                                @error('location_details') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Zoom Link -->
                            <div>
                                <label for="zoom_link" class="block text-sm font-medium text-gray-700">Zoom / Meeting Link</label>
                                <input
                                    id="zoom_link"
                                    type="url"
                                    name="zoom_link"
                                    value="{{ old('zoom_link') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="https://zoom.us/j/..."
                                >
                                @error('zoom_link') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Submit -->
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('events.index') }}" class="px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Cancel
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Create Event
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

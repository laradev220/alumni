<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Edit Profile</h2>
                    <p class="mt-1 text-sm text-gray-600">Update your alumni profile information</p>
                </div>

                @if(session()->has('message'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit="save" enctype="multipart/form-data">
                    <div class="space-y-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                            <input
                                type="text"
                                id="full_name"
                                wire:model="full_name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            >
                            @error('full_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="graduation_year" class="block text-sm font-medium text-gray-700">Graduation Year *</label>
                                <select
                                    id="graduation_year"
                                    wire:model="graduation_year"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >
                                    <option value="">Select Year</option>
                                    @for($year = date('Y'); $year >= 1950; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('graduation_year') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700">Department *</label>
                                <input
                                    type="text"
                                    id="department"
                                    wire:model="department"
                                    placeholder="e.g., Computer Science"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >
                                @error('department') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input
                                    type="text"
                                    id="city"
                                    wire:model="city"
                                    placeholder="e.g., Islamabad"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >
                            </div>

                            <div>
                                <label for="current_job" class="block text-sm font-medium text-gray-700">Current Job</label>
                                <input
                                    type="text"
                                    id="current_job"
                                    wire:model="current_job"
                                    placeholder="e.g., Software Engineer at Google"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="linkedin_url" class="block text-sm font-medium text-gray-700">LinkedIn URL</label>
                            <input
                                type="url"
                                id="linkedin_url"
                                wire:model="linkedin_url"
                                placeholder="https://linkedin.com/in/yourprofile"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            >
                            @error('linkedin_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                            <textarea
                                id="bio"
                                wire:model="bio"
                                rows="4"
                                placeholder="Tell us about yourself..."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            ></textarea>
                            @error('bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="profile_photo" class="block text-sm font-medium text-gray-700">Profile Photo</label>
                            @if($existing_photo)
                                <div class="mt-2 mb-4">
                                    <img
                                        src="{{ Storage::url($existing_photo) }}"
                                        alt="Current profile photo"
                                        class="h-24 w-24 rounded-full object-cover"
                                    >
                                </div>
                            @endif
                            <input
                                type="file"
                                id="profile_photo"
                                wire:model="profile_photo"
                                accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                            >
                            @error('profile_photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="verification_document" class="block text-sm font-medium text-gray-700">
                                Verification Document (CNIC/Roll Number)
                            </label>
                            <p class="text-sm text-gray-500 mt-1">Upload your CNIC or graduation roll number for verification</p>
                            @if($existing_verification_document)
                                <div class="mt-2">
                                    <a
                                        href="{{ Storage::url($existing_verification_document) }}"
                                        target="_blank"
                                        class="text-sm text-indigo-600 hover:text-indigo-900"
                                    >
                                        View uploaded document
                                    </a>
                                </div>
                            @endif
                            <input
                                type="file"
                                id="verification_document"
                                wire:model="verification_document"
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                            >
                            @error('verification_document') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Save Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

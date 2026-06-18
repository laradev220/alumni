<div>
    <button
        wire:click="toggle"
        wire:loading.attr="disabled"
        class="inline-flex items-center px-4 py-2 border text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out disabled:opacity-50 {{ $attending
            ? 'border-red-300 text-red-700 bg-red-50 hover:bg-red-100 focus:ring-red-500'
            : 'border-transparent text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500'
        }}"
    >
        @if($attending)
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Cancel RSVP
        @else
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Attend
        @endif
    </button>
    <span class="ml-3 text-sm text-gray-600">
        {{ $attendingCount }} {{ Str::plural('attendee', $attendingCount) }}
    </span>
</div>

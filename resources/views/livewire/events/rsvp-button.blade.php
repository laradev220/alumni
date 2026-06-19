<div>
    <div class="flex flex-wrap items-center gap-3">
        <button
            wire:click="setStatus('going')"
            wire:loading.attr="disabled"
            class="inline-flex items-center px-4 py-2 border text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out disabled:opacity-50 {{ $currentStatus === 'going'
                ? 'border-indigo-700 text-indigo-700 bg-indigo-50 ring-1 ring-indigo-200'
                : 'border-indigo-200 text-indigo-700 bg-white hover:bg-indigo-50 focus:ring-indigo-500'
            }}"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Going
        </button>

        <button
            wire:click="setStatus('interested')"
            wire:loading.attr="disabled"
            class="inline-flex items-center px-4 py-2 border text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out disabled:opacity-50 {{ $currentStatus === 'interested'
                ? 'border-amber-700 text-amber-700 bg-amber-50 ring-1 ring-amber-200'
                : 'border-amber-200 text-amber-700 bg-white hover:bg-amber-50 focus:ring-amber-500'
            }}"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20h9M3 20h2m2 0h2" />
            </svg>
            Interested
        </button>

        @if($currentStatus)
            <button
                wire:click="clearStatus"
                wire:loading.attr="disabled"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 underline underline-offset-4 disabled:opacity-50"
            >
                Clear RSVP
            </button>
        @endif
    </div>

    <div class="mt-3 flex flex-wrap gap-4 text-sm text-gray-600">
        <span><span class="font-semibold text-gray-900">{{ $goingCount }}</span> going</span>
        <span><span class="font-semibold text-gray-900">{{ $interestedCount }}</span> interested</span>
        <span><span class="font-semibold text-gray-900">{{ $totalCount }}</span> total responses</span>
    </div>
</div>

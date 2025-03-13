<div x-data="{ open: @entangle('isOpen') }" class="w-full h-full">
    <button
        class="bg-crew-500 h-full w-full text-xs text-white py-2 px-4 rounded-sm block text-center transition-all duration-300 transform hover:scale-105 h-full"
        @click="open = true"
    >
        <span class="flex items-center h-full justify-center">Release final programme</span>
    </button>

    <div x-cloak x-show="open"
         class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-900 dark:bg-opacity-75 dark:bg-gray-800 dark:text-gray-200">
        <div class="bg-white p-4 rounded-sm shadow-lg dark:bg-gray-900 ">
            @if($numberOfUnscheduledPresentations != 0)
                <p class="text-gray-700 dark:text-gray-200">You cannot release the final program as there are still
                                                            presentations that are approved but not scheduled. Schedule
                                                            them and then release the schedule.</p>
                <div class="mt-4 flex justify-end">
                    <button @click="open = false" class="text-gray-500 dark:text-gray-200 mr-4">Cancel</button>
                </div>
            @else
                <p class="text-gray-700 dark:text-gray-200">Are you sure you want to release the final programme?</p>
                <div class="mt-4 flex justify-end">
                    <button @click="open = false" class="text-gray-500 dark:text-gray-200 mr-4">Cancel</button>
                    <button wire:click="confirm" class="bg-purple-800 text-white px-4 py-2 rounded-sm">Confirm</button>
                </div>
            @endif
        </div>
    </div>
</div>


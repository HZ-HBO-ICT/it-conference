<div x-data="{ open: @entangle('isOpen') }" class="w-full h-full">
    <button
        class="bg-crew-500 h-full w-full text-xs text-white py-2 px-4 rounded-sm block text-center transition-all duration-300 transform hover:scale-105 h-full"
        @click="open = true"
    >
        <span class="flex items-center h-full justify-center">Reset schedule</span>
    </button>

    <div x-cloak x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-900 dark:bg-opacity-75 dark:bg-gray-800 dark:text-gray-200">
        <div class="bg-white p-4 rounded-sm shadow-lg dark:bg-gray-900 ">
            <p class="text-gray-700 dark:text-gray-200">Are you sure you want to proceed? This would mean that the whole <span class="text-red-600 font-bold">current schedule will be wiped out</span>!</p>
            <p class="text-gray-700 dark:text-gray-200">You will need to go again through the steps of creating opening, closing, scheduling rooms</p>
            <div class="mt-4 flex justify-end">
                <button @click="open = false" class="text-gray-500 dark:text-gray-200 mr-4">Cancel</button>
                <button wire:click="confirm" class="bg-crew-500 text-white px-4 py-2 rounded-sm">Confirm</button>
            </div>
        </div>
    </div>
</div>


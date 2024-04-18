<div x-data="{ open: @entangle('isOpen') }" class="w-full h-full">
    <div
        class="items-center decoration-partner-500 underline rounded-md text-black dark:text-gray-100 hover:cursor-pointer"
        @click="open = true">
        {{$displayText}}
    </div>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition-opacity ease-out duration-400"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-75 bg-gray-900 dark:bg-opacity-75 dark:bg-gray-800 dark:text-gray-200"
    >
        <div class="bg-white w-3/4 p-4 rounded shadow-lg dark:bg-gray-900 text-left">
            <div class="p-5">
                <div class="px-6 py-4">
                    <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{$title}}
                    </div>

                    <div class="mt-4 text-base text-gray-600 dark:text-gray-400">
                        {{str_replace('<br>', "\n", $body)}}
                    </div>
                </div>

                <div class="flex flex-row justify-end px-6 py-4 text-right">
                    <button @click="open = false"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Got it!
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

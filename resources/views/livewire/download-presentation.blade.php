<div class="grid grid-cols-2 gap-2">
    <div>
        <h3 class="text-md font-semibold pb-2">Download presentation slides</h3>
        <p class="text-sm">If the speaker has uploaded slides, you will be able to see them here</p>
    </div>
    <div
        class="px-2 py-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 mt-2">
        <div class="flex items-center justify-center">
            <label wire:click="downloadFile" style="cursor: pointer;"
                   class="flex w-1/2 h-7 mt-4 text-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                </svg>
                Download
            </label>
        </div>
    </div>
</div>

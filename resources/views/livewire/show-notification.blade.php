<div class="p-4 rounded-md bg-blue-300 w-full">
    <div class="flex">
        <div class="shrink-0">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="white" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                      clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="justify-between flex flex-1 ml-3">
            <p class="text-sm text-blue-700">{{$text}}</p>
            <p class="mt-0 ml-6 text-sm">
                <button wire:click="readNotification"
                        class="text-blue-700 font-medium whitespace-nowrap text-xs">
                    Mark as Read
                </button>
            </p>
        </div>
    </div>
</div>

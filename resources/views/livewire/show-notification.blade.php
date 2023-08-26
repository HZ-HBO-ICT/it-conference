<div>
    <div class="bg-gradient-to-br dark:from-blue-900 dark:via-indigo-900 dark:to-purple-900
            from-blue-300 to-indigo-500
            text-white px-4 py-5 mb-4 border-l-4 border-blue-700 rounded-lg flex justify-between items-center">
        <div class="flex-1">
            <p class="text-gray-900 dark:text-gray-200 text-sm">
                {{$text}}
            </p>
        </div>
        <button wire:click="readNotification"
                class="text-xs text-gray-700 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-400">
            Mark as Read
        </button>
    </div>
</div>

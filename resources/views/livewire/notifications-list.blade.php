<div class="pt-2">
    <button wire:click="refreshNotifications"
            class="bg-purple-800 text-white text-sm px-4 py-2 rounded">
        Refresh Notifications
    </button>
    <div class="pt-3">
        @forelse(Auth::user()->unreadNotifications as $notification)
            @livewire('show-notification', ['notification' => $notification], key(($notification->id).time()))
        @empty
            <p class="text-l pt-16 text-gray-800 dark:text-gray-200">There are no new notifications!</p>
        @endforelse
    </div>
</div>

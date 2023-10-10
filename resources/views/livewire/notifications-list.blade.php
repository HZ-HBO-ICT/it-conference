<div>
    <div class="w-full">
        @forelse(Auth::user()->unreadNotifications as $notification)
            @livewire('show-notification', ['notification' => $notification], key(($notification->id).time()))
        @empty
            <p class="text-l pt-16 text-gray-800 dark:text-gray-200">There are no new notifications!</p>
        @endforelse
    </div>
</div>

<x-app-layout>
    <div class="flex flex-col overflow-hidden">
        <div class="relative flex flex-col items-center px-4 py-16">
            <div
                class="flex flex-col md:flex-row justify-start items-start w-full max-w-7xl space-y-8 md:space-y-0 md:space-x-8 mt-6">
                <div
                    class="text-white w-full lg:ml-16 md:w-3/5 font-extrabold text-5xl lg:text-7xl md:text-7xl sm:text-5xl uppercase">
                    <h1 class="leading-extra-tight" style="text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);">
                        {{ $message }}
                    </h1>
                    @if(optional($user))
                        <div class="mt-3 pl-1 uppercase font-bold text-lg">
                            <h2>
                                Attendee name: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200">{{ $user->name }}</span>
                            </h2>
                            <h2>
                                Role: <span class="text-{{ $user->role_colour }}-600 dark:text-{{ $user->role_colour }}-200">{{ $user->role_colour }}</span>
                            </h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

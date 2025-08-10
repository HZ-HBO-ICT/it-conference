<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
        <div class="pt-5">
            <x-list-section>

                <x-slot name="actions">
                    <x-button-link href="{{route('moderator.users.create')}}">
                        {{ __('Invite a new user') }}
                    </x-button-link>
                </x-slot>

                <x-slot name="content">
                    @forelse($users as $index => $user)
                        <x-list-section-item class="{{ !$user->email_verified_at ? 'bg-red-300 dark:bg-red-800' : '' }}"
                                             :url="route('moderator.users.show', $user)">
                            <div class="justify-between flex mt-2">
                                <div class="flex">
                                    <div class="text-gray-700 dark:text-white text-m items-center flex">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                             src="{{ Auth::user()->profile_photo_url }}"
                                             alt="{{ Auth::user()->name }}"/>
                                        <div class="ml-4 grow">
                                            <strong>{{$user->name}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-sm items-center flex ml-2 dark:text-white">
                                    <svg
                                        class="shrink-0 w-6 h-6 mr-1.5 block stroke-crew-400 {{ !$user->email_verified_at ? 'stroke-crew-900 dark:stroke-crew-900 hover:stroke-crew-500' : '' }}"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Registered on: {{$user->created_at->format('d/m/Y')}}
                                </div>
                            </div>
                        </x-list-section-item>
                    @empty
                        <p class="text-crew-400 text-lg justify-center flex m-12">There are currently no users.</p>
                    @endforelse

                    <div class="pt-2">
                        {{ $users->links() }}
                    </div>
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>

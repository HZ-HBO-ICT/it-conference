<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crew Members') }}
        </h2>
        <div class="pt-5">
            <x-list-section>
                <x-slot name="content">
                    @foreach ($roles as $role)
                        <div class="py-5">
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 inline-flex items-center relative">
                                {{ ucfirst($role->name) }}
                                <button
                                    onclick="Livewire.dispatch('openModal', { component: 'crew.role-permissions-info', arguments: {role: {{$role->id}}} })"
                                    class="ml-2 text-gray-400 hover:text-gray-500 relative group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M18 10A8 8 0 1110 2a8 8 0 018 8zM9 9a1 1 0 112 0v4a1 1 0 11-2 0V9zm1-4a1 1 0 100 2 1 1 0 000-2z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-2">
                                @forelse ($role->users as $user)
                                    <div
                                        class="relative bg-white dark:bg-gray-800 shadow rounded-lg p-2 flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}"
                                                 alt="{{ $user->name }}">
                                        </div>
                                        <div>
                                            <div
                                                class="text-md font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                            <div
                                                class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                            @if($user->crew_team)
                                                <div
                                                    class="text-xs text-gray-500 dark:text-gray-400">{{ 'Team: ' . ucfirst($user->crew_team) }}</div>
                                            @endif
                                        </div>
                                        @can('remove-crew-member')
                                            <button
                                                onclick="Livewire.dispatch('openModal', { component: 'crew.revoke-role-of-user', arguments: {user: {{$user->id}}, role: {{$role->id}}} })"
                                                class="absolute top-1 right-1 h-4 w-4 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-700 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18 18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                            @if($role->name == 'event organizer')
                                                <button
                                                    onclick="Livewire.dispatch('openModal', { component: 'crew.add-team', arguments: {user: {{$user->id}}} })"
                                                    class="absolute top-1 right-6 h-4 w-4 rounded-full bg-blue-500 text-white flex items-center justify-center hover:bg-blue-700 focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-3 w-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                                    </svg>
                                                </button>
                                            @endif
                                        @endcan
                                    </div>
                                @empty
                                @endforelse
                                @can('invite-crew-member')
                                    <button
                                        onclick="Livewire.dispatch('openModal', { component: 'crew.assign-role-to-user', arguments: {role: {{$role->id}}} })"
                                        class="bg-white dark:bg-gray-800 text-apricot-peach-500 dark:text-gray-400 shadow rounded-lg p-2 flex items-center space-x-2 hover:cursor-pointer hover:bg-gray-100">
                                        <div class="flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 4.5v15m7.5-7.5h-15"/>
                                            </svg>

                                        </div>
                                        <div>
                                            <div
                                                class="font-medium text-sm">Assign this role to a user
                                            </div>
                                        </div>
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <hr class="border-apricot-peach-200">
                    @endforeach
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>

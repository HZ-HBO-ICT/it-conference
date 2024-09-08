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
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">
                                {{ ucfirst($role->name) }}
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-2">
                                @forelse ($role->users as $user)
                                    <div class="relative bg-white dark:bg-gray-800 shadow rounded-lg p-2 flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                        </div>
                                        <div>
                                            <div class="text-md font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                        </div>

                                        <button onclick="Livewire.dispatch('openModal', { component: 'crew.revoke-role-of-user', arguments: {user: {{$user->id}}, role: {{$role->id}}} })"
                                            class="absolute top-1 right-1 h-4 w-4 rounded-full bg-red-400 text-white flex items-center justify-center hover:bg-red-600 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                @empty
                                @endforelse
                                    <button onclick="Livewire.dispatch('openModal', { component: 'crew.assign-role-to-user', arguments: {role: {{$role->id}}} })"
                                            class="bg-white dark:bg-gray-800 text-apricot-peach-500 dark:text-gray-400 shadow rounded-lg p-2 flex items-center space-x-2 hover:cursor-pointer hover:bg-gray-100">
                                        <div class="flex-shrink-0">
                                            <svg class="h-8 w-8 size-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div
                                                class="font-medium text-sm">Assign this role to a user
                                            </div>
                                        </div>
                                    </button>
                            </div>
                        </div>
                        <hr class="border-apricot-peach-200">
                    @endforeach
                </x-slot>
            </x-list-section>
        </div>
    </div>
</x-hub-layout>

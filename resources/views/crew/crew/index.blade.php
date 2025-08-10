<x-hub-layout>
    <div class="min-h-screen relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 md:px-8 bg-waitt-dark">
        <!-- Decorative Blobs Background -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="mb-6 sm:mb-8">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-2">{{ __('Crew Members') }}</h2>
                <p class="text-base sm:text-lg text-gray-300">Manage crew roles and permissions</p>
            </div>
            
            <div class="space-y-8">
                @foreach ($roles as $role)
                    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-white inline-flex items-center">
                                {{ ucfirst($role->name) }}
                                <button
                                    onclick="Livewire.dispatch('openModal', { component: 'crew.role-permissions-info', arguments: {role: {{$role->id}}} })"
                                    class="ml-2 text-gray-400 hover:text-gray-300 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10A8 8 0 1110 2a8 8 0 018 8zM9 9a1 1 0 112 0v4a1 1 0 11-2 0V9zm1-4a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            @forelse ($role->users as $user)
                                <div class="relative bg-white/10 backdrop-blur-md shadow-lg rounded-xl p-4 flex items-center space-x-4 border border-gray-600">
                                    <div class="shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-md font-medium text-white truncate">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-400 truncate">{{ $user->email }}</div>
                                        @if($user->crew_team)
                                            <div class="text-xs text-gray-400 truncate">{{ 'Team: ' . ucfirst($user->crew_team) }}</div>
                                        @endif
                                    </div>
                                    @can('remove-crew-member')
                                        <button
                                            onclick="Livewire.dispatch('openModal', { component: 'crew.revoke-role-of-user', arguments: {user: {{$user->id}}, role: {{$role->id}}} })"
                                            class="absolute top-2 right-2 h-5 w-5 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        @if($role->name == 'event organizer')
                                            <button
                                                onclick="Livewire.dispatch('openModal', { component: 'crew.add-team', arguments: {user: {{$user->id}}} })"
                                                class="absolute top-2 right-8 h-5 w-5 rounded-full bg-blue-500 text-white flex items-center justify-center hover:bg-blue-600 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-3 w-3" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                                </svg>
                                            </button>
                                        @endif
                                    @endcan
                                </div>
                            @empty
                                <div class="col-span-full text-center py-8">
                                    <p class="text-gray-400">No users assigned to this role.</p>
                                </div>
                            @endforelse
                            
                            @can('invite-crew-member')
                                <button
                                    onclick="Livewire.dispatch('openModal', { component: 'crew.assign-role-to-user', arguments: {role: {{$role->id}}} })"
                                    class="bg-white/10 backdrop-blur-md text-white border border-gray-600 shadow-lg rounded-xl p-4 flex items-center space-x-3 hover:bg-white/20 transition-colors">
                                    <div class="shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-medium text-sm">Assign this role to a user</div>
                                    </div>
                                </button>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-hub-layout>

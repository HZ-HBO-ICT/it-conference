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
        
        <div class="relative z-10 max-w-4xl mx-auto">
            <div class="mb-6">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-2">
                    {{ __('Room details') }}
                </h2>
            </div>
            
            <!-- Room Information Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Room Information') }}</h3>
                    <p class="text-gray-300 text-sm">{{ __('The room basic information.') }}</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-600">
                        <span class="text-white font-medium">Room name</span>
                        <span class="text-white">{{ $room->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-white font-medium">Room maximum capacity/participants</span>
                        <span class="text-white">{{ $room->max_participants }}</span>
                    </div>
                </div>
                
                @can('update', \App\Models\Room::class)
                    <div class="flex justify-end mt-6">
                        <button onclick="Livewire.dispatch('openModal', { component: 'room.edit-room-modal', arguments: {room: {{$room}}} })"
                                class="px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-lg shadow transition">
                            {{ __('Edit details') }}
                        </button>
                    </div>
                @endcan
            </div>
            
            <!-- Delete Room Section -->
            @can('delete', $room)
                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">{{ __('Delete Room') }}</h3>
                            <p class="text-gray-300 text-sm">You can remove the room</p>
                        </div>
                        <button onclick="Livewire.dispatch('openModal', { component: 'room.delete-room-modal', arguments: {room: {{$room}}} })"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-lg shadow transition">
                            {{ __('Delete Room') }}
                        </button>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</x-hub-layout>

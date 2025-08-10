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
                    {{ __('Presentation details') }}
                </h2>
            </div>
            
            <!-- Presentation Information Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Presentation Information') }}</h3>
                    <p class="text-gray-300 text-sm">{{ __('All characteristics of the presentation and its details') }}</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-3 border-b border-gray-600">
                        <span class="text-white font-medium">Presentation title</span>
                        <span class="text-white">{{ $presentation->name }}</span>
                    </div>
                    <div class="flex justify-between items-start py-3 border-b border-gray-600">
                        <span class="text-white font-medium">Presentation description</span>
                        <span class="text-gray-300 text-right max-w-md">{{ $presentation->description }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-gray-600">
                        <span class="text-white font-medium">Presentation type</span>
                        <span class="text-white">{{ $presentation->type }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-gray-600">
                        <span class="text-white font-medium">Difficulty</span>
                        <div class="text-yellow-400 flex" data-te-toggle="tooltip" title="{{ $presentation->difficulty->level }}">
                            @for($i = 0; $i < $presentation->difficulty->id; $i++)
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-white font-medium">Presentation max participants</span>
                        <span class="text-white">{{ $presentation->max_participants }}</span>
                    </div>
                </div>
                
                @can('update', $presentation)
                    <div class="flex justify-end mt-6">
                        <button onclick="Livewire.dispatch('openModal', { component: 'presentation.edit-presentation-modal', arguments: {presentation: {{$presentation}}} })"
                                class="px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-lg shadow transition">
                            {{ __('Edit') }}
                        </button>
                    </div>
                @endcan
            </div>
            
            <!-- Presentation Speakers Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Presentation speakers') }}</h3>
                    <p class="text-gray-300 text-sm">{{ __('Here you can see the people who requested the presentation or joined as co-speakers.') }}</p>
                </div>
                
                <div class="space-y-4">
                    @forelse ($presentation->speakers->sortBy('name') as $user)
                        <div class="flex items-center justify-between p-3 bg-white/5 rounded-lg border border-gray-600">
                            <div class="flex items-center">
                                <img class="w-8 h-8 rounded-full object-cover"
                                     src="{{ $user->profile_photo_url }}"
                                     alt="{{ $user->name }}">
                                <div class="ml-4 leading-tight">
                                    <div class="text-white font-medium">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="text-gray-400">
                                @if($user->company)
                                    <a class="underline text-waitt-pink-400 hover:text-waitt-pink-300 transition-colors" 
                                       href="{{route('moderator.companies.show', $user->company)}}">
                                        {{$user->company->name}}
                                    </a>
                                @else
                                    <span class="text-gray-300">Independent speaker</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <span class="text-orange-400">Something had gone wrong — no speakers were found. Contact the development team.</span>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Approval Status Section -->
            @can('viewRequest', $presentation)
                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('Approval Status') }}</h3>
                        <p class="text-gray-300 text-sm">{{ __('When the status is Approved, the presentation and speaker will show up at the lineup.') }}</p>
                    </div>
                    
                    <div class="text-sm leading-6 text-{{ $presentation->is_approved ? 'green-400' : 'yellow-400' }} font-semibold">
                        {{ $presentation->is_approved ? 'Approved' : 'Awaiting approval' }}
                    </div>
                    
                    @can('approve', $presentation)
                        @if(!$presentation->is_approved)
                            <div class="flex space-x-2 mt-4">
                                <button onclick="Livewire.dispatch('openModal', { component: 'confirmation-modal', arguments: { title: 'Approve presentation', method: 'POST', route: '{{ route('moderator.presentations.approve', ['presentation' => $presentation, 'isApproved' => 1]) }}', isApproved: 1 } })"
                                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow transition">
                                    {{ __('Approve') }}
                                </button>
                                <button onclick="Livewire.dispatch('openModal', { component: 'confirmation-modal', arguments: { title: 'Reject presentation', method: 'POST', route: '{{ route('moderator.presentations.approve', ['presentation' => $presentation, 'isApproved' => 0]) }}', isApproved: 0 } })"
                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-lg shadow transition">
                                    {{ __('Reject') }}
                                </button>
                            </div>
                        @endif
                    @endcan
                </div>
            @endcan
            
            <!-- Participants Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Participants') }}</h3>
                    <p class="text-gray-300 text-sm">{{ __('List of people who signed up for the presentation.') }}</p>
                </div>
                
                <div class="px-4 py-6">
                    <ul class="space-y-2">
                        @forelse($presentation->participants as $participant)
                            <li class="text-white py-2 border-b border-gray-600 last:border-b-0">
                                {{$participant->name}} <span class="text-gray-400">({{$participant->email}})</span>
                            </li>
                        @empty
                            <li class="text-gray-300">There are no participants that have registered just yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            
            <!-- Delete Button -->
            @can('delete', $presentation)
                <div class="flex justify-end">
                    <button onclick="Livewire.dispatch('openModal', { component: 'presentation.delete-presentation-modal', arguments: {presentation: {{$presentation}}} })"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-lg shadow transition">
                        {{ __('Delete Presentation') }}
                    </button>
                </div>
            @endcan
        </div>
    </div>
</x-hub-layout>

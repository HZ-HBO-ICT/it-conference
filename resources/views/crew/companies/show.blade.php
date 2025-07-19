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
                    {{ __('Company details') }}
                </h2>
            </div>
            
            <!-- Company Information Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Company Information') }}</h3>
                    <p class="text-gray-300 text-sm">{{ __('The company\'s name, address and other information that is visible for all users.') }}</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex-col">
                            @if($company->logo_path)
                                <img class="w-56 h-56 mx-auto my-auto max-w-full block"
                                     src="{{ url('storage/'. $company->logo_path) }}" alt="Logo of {{$company->name}}">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="white" aria-hidden="true" class="w-24 h-24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-col grow pl-2 pt-3 text-white">
                            <h3 class="text-xl font-semibold">{{ $company->name }}</h3>
                            <p class="text-sm text-gray-300">
                                {{ $company->street }} {{ $company->house_number }} <br>
                                {{ $company->postcode }}  {{ $company->city }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="text-white pt-3">
                        <span class="font-semibold">Website:</span> 
                        <a class="underline text-waitt-pink-400 hover:text-waitt-pink-300 transition-colors"
                           href="{{$company->website}}">{{ $company->website }}</a>
                    </div>
                    
                    @if($company->description)
                        <div class="text-white pt-3">
                            <span class="font-semibold">Description:</span> 
                            <span class="text-gray-300">{{ $company->description }}</span>
                        </div>
                    @endif
                    
                    @if($company->motivation)
                        <div class="text-white pt-3">
                            <span class="font-semibold">Motivation:</span> 
                            <span class="text-gray-300">{{ $company->motivation }}</span>
                        </div>
                    @endif
                </div>
                
                @can('update', $company)
                    <div class="flex justify-end mt-6">
                        <button onclick="Livewire.dispatch('openModal', { component: 'company.edit-company-modal', arguments: {company: {{$company}}} })"
                                class="px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-lg shadow transition">
                            {{ __('Edit details') }}
                        </button>
                    </div>
                @endcan
            </div>
            
            <!-- Internship Opportunities Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Internship Opportunities') }}</h3>
                    <p class="text-gray-300 text-sm">{{ __('Here you can see the internship opportunities the company has specified') }}</p>
                </div>
                
                @if(!$company->internshipAttributes->isEmpty())
                    <div class="space-y-4">
                        @if($company->internshipAttributes()->years()->exists())
                            <div class="bg-white/5 p-4 rounded-lg border border-gray-600">
                                <h4 class="font-semibold text-white mb-2">Internship for years:</h4>
                                <p class="text-sm text-gray-300">{{ implode(', ', $company->internshipAttributes()->years()->pluck('value')->toArray()) }}</p>
                            </div>
                        @endif
                        @if($company->internshipAttributes()->tracks()->exists())
                            <div class="bg-white/5 p-4 rounded-lg border border-gray-600">
                                <h4 class="font-semibold text-white mb-2">Internship for tracks:</h4>
                                <p class="text-sm text-gray-300">{{ implode(', ', $company->internshipAttributes()->tracks()->pluck('value')->toArray()) }}</p>
                            </div>
                        @endif
                        @if($company->internshipAttributes()->languages()->exists())
                            <div class="bg-white/5 p-4 rounded-lg border border-gray-600">
                                <h4 class="font-semibold text-white mb-2">Internship in the following languages:</h4>
                                <p class="text-sm text-gray-300">{{ implode(', ', $company->internshipAttributes()->languages()->pluck('value')->toArray()) }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <div>
                        <p class="text-gray-300">No internship details were specified.</p>
                    </div>
                @endif
            </div>
            
            <!-- Company Members Section -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Company Members') }}</h3>
                    <p class="text-gray-300 text-sm">{{ __('The participants who are related to this company.') }}</p>
                </div>
                
                <div class="text-white">
                    <ul class="space-y-3">
                        @forelse($company->users as $user)
                            <li class="flex items-center p-3 bg-white/5 rounded-lg border border-gray-600">
                                <!-- Profile Image -->
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                     class="w-10 h-10 rounded-full object-cover mr-3">

                                <!-- User Information -->
                                <div class="flex-1">
                                    <div class="font-semibold text-base text-white">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $user->email }}
                                    </div>
                                    <!-- User Roles -->
                                    @if($user->roles->isNotEmpty())
                                        <div class="text-xs text-gray-400 mt-1">
                                            {{ __('Roles: ') }}{{ optional($user->mainRoles())->join(', ') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Company Representative Badge -->
                                @if($company->representative->id == $user->id)
                                    <span class="ml-3 px-2 py-0.5 bg-green-500 text-white text-xs font-bold rounded-md">
                                        {{ __('Company Representative') }}
                                    </span>
                                @endif
                            </li>
                        @empty
                            <li class="text-sm text-gray-400">
                                {{ __('There are currently no users in this company.') }}
                            </li>
                        @endforelse
                    </ul>
                </div>
                
                @can('addMember', $company)
                    <div class="flex justify-end mt-6">
                        @if ($company->is_approved)
                            <button onclick="Livewire.dispatch('openModal', { component: 'company.add-participant', arguments: {companyId: {{$company->id}}} })"
                                    class="px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-lg shadow transition">
                                {{ __('Add Participant') }}
                            </button>
                        @else
                            <div>
                                <p class="text-sm text-gray-300">The company must be approved before adding participants.</p>
                            </div>
                        @endif
                    </div>
                @endcan
            </div>
            
            <!-- Company Approval Status Section -->
            @can('viewRequest', $company)
                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl mb-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('Company Approval Status') }}</h3>
                        <p class="text-gray-300 text-sm">{{ __('When the status is approved, the company will show up at the lineup. The company is also able to request for presentations, sponsorships and booths.') }}</p>
                    </div>
                    
                    <div class="text-sm leading-6 text-{{ $company->is_approved ? 'green-400' : 'yellow-400' }} font-semibold">
                        {{ $company->is_approved ? 'Approved' : 'Awaiting approval' }}
                    </div>
                    
                    @can('approveRequest', $company)
                        @if(!$company->is_approved)
                            <div class="flex space-x-2 mt-4">
                                <button onclick="Livewire.dispatch('openModal', { component: 'confirmation-modal', arguments: { title: 'Approve company', method: 'POST', route: '{{ route('moderator.companies.approve', ['company' => $company, 'isApproved' => 1]) }}', isApproved: 1 } })"
                                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow transition">
                                    {{ __('Approve') }}
                                </button>
                                <button onclick="Livewire.dispatch('openModal', { component: 'confirmation-modal', arguments: { title: 'Reject company', method: 'POST', route: '{{ route('moderator.companies.approve', ['company' => $company, 'isApproved' => 0]) }}', isApproved: 0 } })"
                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-bold rounded-lg shadow transition">
                                    {{ __('Reject') }}
                                </button>
                            </div>
                        @endif
                    @endcan
                </div>
            @endcan
            
            <!-- Company Booth Section -->
            @can('view', $company->booth)
                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-white mb-2">{{ __('Company Booth') }}</h3>
                        <p class="text-gray-300 text-sm">{{ __('Determines the stand for the company') }}</p>
                    </div>
                    
                    <div>
                        @if(!$company->booth)
                            <p class="text-yellow-400">Not requested</p>
                        @elseif(!$company->booth->is_approved)
                            <p class="text-yellow-400">Not approved/Waiting approval. 
                                <a class="underline text-waitt-pink-400 hover:text-waitt-pink-300 transition-colors" 
                                   href="{{route('moderator.booths.show', $company->booth)}}">See more here</a>
                            </p>
                        @else
                            <p class="text-green-400">Approved. 
                                <a class="underline text-waitt-pink-400 hover:text-waitt-pink-300 transition-colors" 
                                   href="{{route('moderator.booths.show', $company->booth)}}">See more here</a>
                            </p>
                        @endif
                    </div>
                </div>
            @endcan
        </div>
    </div>
</x-hub-layout>

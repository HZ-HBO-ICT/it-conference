@php
    use App\Models\Company;
    use App\Enums\ApprovalStatus;
@endphp

<form wire:submit="save">
    @csrf
    <div class="space-y-6">
        <!-- Booth Details Section -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Booth Details</h3>
            <div class="space-y-4">
                <div>
                    <label for="company_id" class="block text-sm font-medium text-white mb-2">
                        Company name <span class="text-red-400">*</span>
                    </label>
                    <select wire:model="companyId" name="company_id" 
                            class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                        <option value="">Select company...</option>
                        @foreach(Company::whereDoesntHave('booth')
                                    ->hasStatus(ApprovalStatus::APPROVED)->get() as $company)
                            <option value="{{ $company->id }}">
                                {{$company->name}}
                                @if($company->sponsorship)
                                    ({{ucfirst($company->sponsorship->name)}} sponsor)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('company')  
                        <p class="text-red-400 text-sm mt-1">{{$message}}</p> 
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="width" class="block text-sm font-medium text-white mb-2">
                            Width (meters) <span class="text-red-400">*</span>
                        </label>
                        <input wire:model="width" name="width" type="number" step="0.1" min="1" 
                               class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                        @error('width')  
                            <p class="text-red-400 text-sm mt-1">{{$message}}</p> 
                        @enderror
                    </div>
                    
                    <div>
                        <label for="length" class="block text-sm font-medium text-white mb-2">
                            Length (meters) <span class="text-red-400">*</span>
                        </label>
                        <input wire:model="length" name="length" step="0.1" min="1" type="number" 
                               class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                        @error('length')  
                            <p class="text-red-400 text-sm mt-1">{{$message}}</p> 
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="additionalInformation" class="block text-sm font-medium text-white mb-2">
                        Additional information
                    </label>
                    <textarea wire:model="additionalInformation" maxlength="255" rows="3"
                              class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent resize-none"
                              placeholder="Any additional information about the booth..."></textarea>
                    @error('additionalInformation')  
                        <p class="text-red-400 text-sm mt-1">{{$message}}</p> 
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Sponsor Package Information -->
        <div class="bg-white/5 rounded-xl p-4">
            <h4 class="text-md font-semibold text-white mb-3">Total area sizes mentioned in sponsor packages:</h4>
            <ul class="space-y-2 text-gray-300">
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-bronze-500 rounded-full"></span>
                    <span>Bronze & Silver - 8 m²</span>
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                    <span>Golden - 12 m²</span>
                </li>
            </ul>
        </div>
        
        <!-- Booth Owner Section -->
        <div>
            <h3 class="text-lg font-semibold text-white mb-4">Booth Owner</h3>
            <div>
                <label for="booth_owner" class="block text-sm font-medium text-white mb-2">
                    Choose company member to become the booth owner <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <input
                        class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                        type="text" maxlength="255" wire:focus="toggleDropdown"
                        wire:model.live="searchValue" placeholder="Search for a user...">
                    
                    @if($isDropdownVisible)
                        <div class="absolute z-50 w-full mt-1 max-h-48 rounded-lg overflow-auto bg-white/10 backdrop-blur-md border border-gray-600">
                            <ul>
                                @if($users)
                                    @forelse($users as $user)
                                        <li wire:click="selectUser({{$user->id}})" wire:key="{{$user->id}}"
                                            class="hover:cursor-pointer w-full" onclick="event.stopPropagation()">
                                            <div class="hover:bg-white/10 p-3 flex items-center space-x-3 transition-colors">
                                                <img class="h-8 w-8 rounded-full shrink-0" src="{{ $user->profile_photo_url }}"
                                                     alt="{{ $user->name }}">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-white truncate">{{ $user->name }}</p>
                                                    <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="py-3 px-3">
                                            <p class="text-sm font-medium text-gray-400">No results found.</p>
                                        </li>
                                    @endforelse
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
                
                @if($selectedUser && !$isDropdownVisible)
                    <div class="mt-2 p-3 bg-white/5 rounded-lg">
                        <p class="text-xs text-gray-300">
                            Selected user: <span class="font-medium text-white">{{ $selectedUser->name }}</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Current roles: {{ $selectedUser->allRoles->implode(', ') }}
                        </p>
                    </div>
                @endif
                
                @error('selectedUser')  
                    <p class="text-red-400 text-sm mt-1">{{$message}}</p> 
                @enderror
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-end pt-6">
            <button type="submit" 
                    class="px-6 py-3 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-xl shadow transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Save Booth
            </button>
        </div>
    </div>
</form>

@php use App\Models\User @endphp
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
                    {{ __('Create a company') }}
                </h2>
                <p class="text-base sm:text-lg text-gray-300">
                    Add manually a new company that will join the conference
                </p>
            </div>
            
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl">
                <form method="POST" action="{{route('moderator.companies.store')}}">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Company Details Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Company Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-white mb-2">
                                        Company Name <span class="text-red-400">*</span>
                                    </label>
                                    <input name="name" type="text" 
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{ old('name') }}" autofocus>
                                    @error('name')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-white mb-2">
                                        Phone Number <span class="text-gray-400 text-xs">(optional)</span>
                                    </label>
                                    <input name="phone_number" type="tel" 
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{ old('phone_number') }}">
                                    @if ($errors->has('phone_number'))
                                        <p class="text-red-400 text-sm mt-1">Invalid phone number</p>
                                    @endif
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-white mb-2">
                                        Company Description <span class="text-red-400">*</span>
                                    </label>
                                    <textarea name="description" rows="4"
                                              class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent resize-none">{{old('description')}}</textarea>
                                    @error('description')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="website" class="block text-sm font-medium text-white mb-2">
                                        Website <span class="text-red-400">*</span>
                                    </label>
                                    <div class="flex">
                                        <span class="flex items-center px-3 py-2 bg-white/10 border border-gray-600 border-r-0 rounded-l-lg text-gray-300 text-sm">
                                            https://
                                        </span>
                                        <input id="website" name="website" type="text" 
                                               class="flex-1 px-3 py-2 bg-white/10 border border-gray-600 rounded-r-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                               placeholder="www.example.com" value="{{ old('website') }}" required>
                                    </div>
                                    @error('website')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Address Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Address</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="postcode" class="block text-sm font-medium text-white mb-2">
                                        Postcode <span class="text-red-400">*</span>
                                    </label>
                                    <input name="postcode" type="text" 
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{ old('postcode') }}">
                                    @error('postcode')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="house_number" class="block text-sm font-medium text-white mb-2">
                                        House Number <span class="text-red-400">*</span>
                                    </label>
                                    <input name="house_number" type="text" 
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{ old('house_number') }}">
                                    @error('house_number')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="street" class="block text-sm font-medium text-white mb-2">
                                        Street <span class="text-red-400">*</span>
                                    </label>
                                    <input name="street" type="text" 
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{ old('street') }}">
                                    @error('street')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="city" class="block text-sm font-medium text-white mb-2">
                                        City <span class="text-red-400">*</span>
                                    </label>
                                    <input name="city" type="text" 
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{ old('city') }}">
                                    @error('city')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Company Representative Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Company Representative</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-white mb-2">
                                        If they <strong>have registered</strong> already:
                                    </label>
                                    <select name="rep_email" 
                                            class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                                        <option value="">Select user...</option>
                                        @foreach(User::forCompanyRep()->get() as $user)
                                            <option value="{{ $user->email }}" {{ old('rep_email') == $user->email ? 'selected' : '' }}>
                                                {{ $user->name }} | {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="text-center">
                                    <span class="text-gray-300 text-sm">OR</span>
                                </div>
                                
                                <div>
                                    <label for="rep_new_email" class="block text-sm font-medium text-white mb-2">
                                        If they <strong>do not have an account</strong> yet:
                                    </label>
                                    <input name="rep_new_email" type="email" 
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{ old('rep_new_email') }}" placeholder="john.doe@example.com">
                                    @error('rep_new_email')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit" 
                                    class="px-6 py-3 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-xl shadow transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Save Company
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-hub-layout>

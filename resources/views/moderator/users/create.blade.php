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
                    {{ __('Invite a new user') }}
                </h2>
                <p class="text-base sm:text-lg text-gray-300">
                    Add manually a new user to the conference
                </p>
            </div>
            
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-white mb-4">User Details</h3>
                    <div class="text-sm text-gray-300 space-y-2">
                        <p>{{ __('Add manually a new user that will join the conference.') }}</p>
                        <p><strong>NOTE:</strong> The user will be added as participant by default</p>
                        <p class="pt-3">If you want the user to be a speaker, after inviting them, you can add the presentation. If you want them to be a company representative, you can 
                            <a class="text-waitt-pink-400 hover:text-waitt-pink-300 underline transition-colors" href="{{route('moderator.companies.create')}}">add them directly from here</a>, without creating them now.</p>
                    </div>
                </div>
                
                <form method="POST" action="{{route('moderator.users.store')}}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-white mb-2">
                                Full Name <span class="text-red-400">*</span>
                            </label>
                            <input id="name" name="name" type="text" 
                                   class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                   value="{{old('name')}}" autofocus>
                            @error('name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-white mb-2">
                                Email <span class="text-red-400">*</span>
                            </label>
                            <input id="email" name="email" type="email" 
                                   class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                   value="{{old('email')}}">
                            @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="institution" class="block text-sm font-medium text-white mb-2">
                                Institution
                            </label>
                            <input id="institution" name="institution" type="text" 
                                   class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                   value="{{old('institution')}}">
                            @error('institution')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit" 
                                    class="px-6 py-3 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-xl shadow transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Save User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-hub-layout>

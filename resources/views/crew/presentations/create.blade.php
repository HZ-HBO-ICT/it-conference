@php use App\Models\Difficulty; @endphp
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
                    {{ __('Create a new presentation') }}
                </h2>
                <p class="text-base sm:text-lg text-gray-300">
                    Add manually a new presentation that will be hosted during the conference
                </p>
            </div>
            
            <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 sm:p-8 shadow-2xl">
                <form method="POST" action="{{route('moderator.presentations.store')}}">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Presentation Details Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Presentation Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-white mb-2">
                                        Title <span class="text-red-400">*</span>
                                    </label>
                                    <input id="name" name="name" type="text" maxlength="255"
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{old('name')}}" autofocus>
                                    @error('name')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-white mb-2">
                                        Description <span class="text-red-400">*</span>
                                    </label>
                                    <textarea name="description" rows="4" maxlength="300"
                                              class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent resize-none">{{old('description')}}</textarea>
                                    @error('description')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="presentation_type_id" class="block text-sm font-medium text-white mb-2">
                                        Type of presentation <span class="text-red-400">*</span>
                                    </label>
                                    <select name="presentation_type_id"
                                            class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                                        @foreach($presentationTypes as $presentationType)
                                            @php
                                                $selected = old('presentation_type_id', 1) == $presentationType->id ? 'selected' : '';
                                            @endphp
                                            <option value="{{ $presentationType->id }}" {{ $selected }}>
                                                {{ $presentationType->name }} ({{ $presentationType->duration }} minutes)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('presentation_type_id')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="difficulty_id" class="block text-sm font-medium text-white mb-2">
                                        Difficulty of the presentation <span class="text-red-400">*</span>
                                    </label>
                                    <select name="difficulty_id"
                                            class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                                        @foreach(Difficulty::all() as $difficulty)
                                            <option value="{{$difficulty->id}}" {{old('difficulty_id') == $difficulty->id ? 'selected' : ''}}>
                                                {{ucfirst($difficulty->level)}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('difficulty_id')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="max_participants" class="block text-sm font-medium text-white mb-2">
                                        Preferred number of maximum participants <span class="text-red-400">*</span>
                                    </label>
                                    <input id="max_participants" name="max_participants" type="number"
                                           class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                                           value="{{old('max_participants')}}">
                                    @error('max_participants')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Speaker Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-4">Main Speaker</h3>
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-white mb-2">
                                    Main Speaker <span class="text-red-400">*</span>
                                </label>
                                <select name="user_id" 
                                        class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                                    <option value="">Select speaker...</option>
                                    @foreach($users as $user)
                                        @if(!$user->hasRole('crew'))
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} | {{ $user->email }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
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
                                Save Presentation
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-hub-layout>

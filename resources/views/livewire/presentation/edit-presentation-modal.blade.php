<x-livewire-modal form-action="save">
    <x-slot name="title" class="bg-waitt-dark border-gray-600">
        <h3 class="text-lg leading-6 font-medium text-white">
            Edit presentation
        </h3>
    </x-slot>

    <x-slot name="description" class="bg-waitt-dark">
        <p class="text-gray-300 text-sm">{{ __('Here you can edit your presentation details until 12th of October.') }}</p>
    </x-slot>

    <x-slot name="content" class="w-full bg-waitt-dark">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <!-- Presentation Title -->
                <dt class="text-sm font-medium leading-6 text-white">Presentation Title</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                        type="text" maxlength="255" wire:model="form.name">
                    @error('form.name') 
                        <span class="error text-red-400 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </dd>

                <!-- Presentation Description -->
                <dt class="text-sm font-medium leading-6 text-white">Presentation Description</dt>
                <dd class="sm:col-span-2">
                    <textarea rows="7"
                        class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent resize-none"
                        wire:model="form.description" maxlength="300"></textarea>
                    @error('form.description') 
                        <span class="error text-red-400 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </dd>

                <!-- Presentation Type -->
                <dt class="text-sm font-medium leading-6 text-white">Presentation Type</dt>
                <dd class="sm:col-span-2">
                    <select wire:model="form.presentation_type_id"
                            class="mt-1 w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                        @foreach($presentationTypes as $presentationType)
                            <option value={{$presentationType->id}}
                                {{$presentationType->id == $presentation->presentation_type_id ? 'selected' : ''}}
                                class="bg-waitt-dark text-white">
                                {{$presentationType->name}} ({{$presentationType->duration}} minutes)
                            </option>
                        @endforeach
                    </select>
                    @error('form.presentation_type_id') 
                        <span class="error text-red-400 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </dd>

                <!-- Difficulty Level -->
                <dt class="text-sm font-medium leading-6 text-white">Difficulty Level</dt>
                <dd class="sm:col-span-2">
                    <select wire:model="form.difficulty_id"
                            class="mt-1 w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent">
                        @foreach(App\Models\Difficulty::all() as $difficulty)
                            <option value="{{$difficulty->id}}" class="bg-waitt-dark text-white">
                                {{ucfirst($difficulty->level)}}
                            </option>
                        @endforeach
                    </select>
                    @error('form.difficulty_id') 
                        <span class="error text-red-400 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </dd>

                <!-- Suggested Max Participants -->
                <dt class="text-sm font-medium leading-6 text-white">Suggested Max Participants</dt>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                        type="number" wire:model="form.max_participants">
                    @error('form.max_participants') 
                        <span class="error text-red-400 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="bg-waitt-dark">
        <button type="button" wire:click="$dispatch('closeModal')" 
                class="mr-3 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg shadow transition">
            {{ __('Cancel') }}
        </button>
        <button type="submit"
                class="px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-lg shadow transition">
            Save
        </button>
    </x-slot>
</x-livewire-modal>

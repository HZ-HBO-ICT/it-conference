<x-waitt.livewire-modal form-action="save">
    <x-slot name="title" class="dark:bg-gray-900 border-gray-800">
        Edit presentation
    </x-slot>

    <x-slot name="description" class="dark:bg-gray-800">
        {{ __('Here you can edit your presentation details until 12th of October.') }}
    </x-slot>

    <x-slot name="content" class="w-full dark:bg-gray-800">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <!-- Presentation Title -->
                <x-waitt.label for="form.name" value="{{ __('Presentation Title') }}"/>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="text" maxlength="255" wire:model="form.name">
                    @error('form.name') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Presentation Description -->
                <x-waitt.label for="form.description" value="{{ __('Presentation Description') }}"/>
                <dd class="sm:col-span-2">
                <textarea rows="7"
                          class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                          wire:model="form.description" maxlength="300"></textarea>
                    @error('form.description') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Presentation Type -->
                <x-waitt.label for="form.presentation_type_id" value="{{ __('Presentation Type') }}"/>
                <dd class="sm:col-span-2">
                    <select wire:model="form.presentation_type_id"
                            class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block">
                        @foreach($presentationTypes as $presentationType)
                            <option value={{$presentationType->id}}
                                {{$presentationType->id == $presentation->presentation_type_id ? 'selected' : ''}}
                            >
                                {{$presentationType->name}} ({{$presentationType->duration}} minutes)
                            </option>
                        @endforeach
                    </select>
                    @error('form.presentation_type_id') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Difficulty Level -->
                <x-waitt.label for="name" value="{{ __('Difficulty Level') }}"/>
                <dd class="sm:col-span-2">
                    <select wire:model="form.difficulty_id"
                            class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        @foreach(App\Models\Difficulty::all() as $difficulty)>
                            <option value="{{$difficulty->id}}">{{ucfirst($difficulty->level)}}</option>
                        @endforeach
                    </select>
                    @error('form.difficulty_id') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>

                <!-- Suggested Max Participants -->
                <x-waitt.label for="name" value="{{ __('Suggested Max Participants') }}"/>
                <dd class="sm:col-span-2">
                    <input
                        class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block"
                        type="number" wire:model="form.max_participants">
                    @error('form.max_participants') <span class="error text-red-500">{{ $message }}</span> @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-waitt.button type="button" wire:click="$dispatch('closeModal')" class="mr-3">
            {{ __('Cancel') }}
        </x-waitt.button>
        <x-waitt.button type="submit" variant="save">
            Save
        </x-waitt.button>
    </x-slot>
</x-waitt.livewire-modal>

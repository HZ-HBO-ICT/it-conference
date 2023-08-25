<x-action-section>
    <x-slot name="title">
        {{ __('Company logo') }}
    </x-slot>

    <x-slot name="description">
        {{ __("Add the logo of your company. If you don't upload one a placeholder will be used") }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save" class="space-y-8">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <x-label for="photo" value="{{ __('Photo') }}"/>
                        @if ($team->logo_path && !$photo)
                            <x-label for="preview" value="{{ __('Current logo') }}" class="pt-3 pb-1"/>
                            <img src="{{ url('storage/'. $team->logo_path) }}" class="object-fill w-full h-72"/>
                            @if (session()->has('message'))
                                <div class="text-sm text-green-600">
                                    {{ session('message') }}
                                </div>
                            @endif
                        @endif
                        @if ($photo)
                            <x-label for="preview" value="{{ __('Photo preview') }}" class="pt-3 pb-1"/>
                            <img src="{{ $photo->temporaryUrl() }}" class="object-fill w-full h-72">
                        @endif
                        <div class="mt-1 flex items-center">
                            <input type="file" id="photo" wire:model="photo"
                                   class="hidden">
                            <label for="photo"
                                   class="flex items-center justify-center w-1/3 h-10 px-4 mt-2 text-sm font-medium text-white bg-indigo-600 rounded-md cursor-pointer hover:bg-indigo-700 focus-within:bg-indigo-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Upload Logo
                            </label>
                        </div>
                        @error('photo') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Photo
                    </button>
                </div>
            </div>
        </form>
    </x-slot>
</x-action-section>

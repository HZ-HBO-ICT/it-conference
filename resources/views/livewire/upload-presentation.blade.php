@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\EventInstance;
@endphp
<x-form-section submit="save">
    <x-slot name="title">
        {{ __('Presentation file') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your presentation handout file.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            @if ($presentation->file_path)
                <x-label for="preview" value="{{ __('Current presentation') }}" class="pt-3 pb-1"/>
                <p wire:click="downloadFile" style="cursor: pointer;">
                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="text-blue-600">
                                {{ basename($presentation->file_path) }}
                            </span>
                </p>
                @if (session()->has('message'))
                    <div class="text-sm text-green-600">
                        {{ session('message') }}
                    </div>
                @endif
            @endif
            @if($presentation->file_path)
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                    <span class="truncate font-medium">{{$presentation->file_path}}</span>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                </div>
            @else
                <span class="truncate font-medium">
                                    {{ __('No presentation uploaded') }}
                                </span>
            @endif
        </div>

        <div class="col-span-6 sm:col-span-4">
            <input type="file" id="file" wire:model="file"
                   class="hidden">
            <label for="file"
                   class="flex items-center justify-center">
                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="submit">
                    {{ __('Select A New Presentation') }}
                </x-secondary-button>
            </label>


            @if ($presentation->file_path)
                <x-secondary-button type="button" class="mt-2" wire:click="">
                    {{ __('Remove Presentation') }}
                </x-secondary-button>
            @endif

        <div class="space-y-8 divide-y divide-gray-200">
            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <x-label for="photo" value="{{ __('Presentation') }}"/>
                    @if(!Auth::user()->hasRole('content moderator') && !EventInstance::current()->is_final_programme_released)
                        @if(Auth::user()->speaker->presentation_id == $presentation->id)
                            <div class="mt-1 flex items-center">
                            </div>
                        @endif
                    @endif
                    @if($file && !session()->has('message'))
                        <p class="text-gray-500">{{ $filename }}</p>
                    @endif
                    @error('file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
        @if(!Auth::user()->hasRole('content moderator') && !EventInstance::current()->is_final_programme_released)
            @if(Auth::user()->speaker->presentation_id == $presentation->id && $file && !session()->has('message'))
                <div class="pt-5">
                    <div class="flex justify-end">
                        <button type="submit"
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            @endif
        @endif
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

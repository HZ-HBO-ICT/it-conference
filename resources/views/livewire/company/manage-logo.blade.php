<form wire:submit.prevent="save" class="space-y-8">
    <div class="space-y-8 divide-y divide-gray-200">
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-6">
                @if ($currentLogo && !$photo)
                    <x-label for="preview" value="Current {{$theme}} theme logo" class="pb-1 text-center"/>
                    <div class="flex items-center justify-center">
                        <img src="{{ url('storage/'. $currentLogo) }}"
                             class="object-contain {{$theme == 'light' ? 'bg-gray-50' : 'bg-gray-800'}} border border-2 border-partner-500 rounded-full w-64 h-64"/>
                    </div>
                    @if (session()->has('message'))
                        <div class="text-sm text-green-600">
                            {{ session('message') }}
                        </div>
                    @endif
                @elseif ($photo && in_array($photo->getMimeType(), config('livewire.temporary_file_upload.preview_mimes')))
                    <x-label for="preview" value="{{ucfirst($theme)}} theme logo preview" class="text-center pb-1"/>
                    <div class="flex items-center justify-center">
                        <img src="{{ $photo->temporaryUrl() }}" class="object-contain {{$theme == 'light' ? 'bg-gray-50' : 'bg-gray-800'}} border border-2 border-partner-500 h-64 w-64 rounded-full">
                    </div>
                @else
                    <x-label for="preview" value="Upload {{$theme}} theme logo" class="pb-1 text-center"/>
                @endif
                @can('update', $company)
                    <div class="grid grid-cols-2 mt-2 gap-2">
                        <div class="{{$photo ? 'col-span-1' : 'col-span-2'}} flex items-center">
                            <input type="file" id="{{$theme}}" wire:model="photo"
                                   class="hidden">
                            <label for="{{$theme}}"
                                   class="w-full flex items-center justify-center w-1/3 h-10 px-4 text-sm font-medium text-white bg-partner-600 rounded-md cursor-pointer hover:bg-partner-600 focus-within:bg-partner-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Upload {{$photo ||  $currentLogo ? 'new' : ''}} {{$theme}} logo
                            </label>
                        </div>
                        <div>
                            @if($photo && in_array($photo->getMimeType(), config('livewire.temporary_file_upload.preview_mimes')))
                                @if($photo->temporaryUrl())
                                    <div class="w-full h-full flex justify-end">
                                        <button type="submit"
                                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Save Photo
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endcan
                @error('photo') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</form>

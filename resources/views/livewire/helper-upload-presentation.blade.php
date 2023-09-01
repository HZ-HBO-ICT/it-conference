<div class="col-span-6 sm:col-span-4">
    <x-label for="file" value="Upload the presentation slides"/>
    <input type="text" name="file_path" value="{{$path}}" class="hidden">
    <input type="file" id="file" wire:model="file"
           class="hidden">
    <label for="file"
           class="flex items-center justify-center w-1/3 h-10 px-4 mt-2 text-sm font-medium text-white bg-indigo-600 rounded-md cursor-pointer hover:bg-indigo-700 focus-within:bg-indigo-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Upload a file
    </label>
    <div class="text-sm text-green-600">
        {{ session('message') }}
    </div>
    @error('file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

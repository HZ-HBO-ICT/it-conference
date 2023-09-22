@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\EventInstance;
@endphp

<div class="pt-5">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Presentation file</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Upload your presentation handout file
                </p>
            </div>
            <div class="px-4 sm:px-0">
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if ($presentation->file_path)
                    <div class="bg-gray-50 dark:bg-gray-800 mt-5 p-3 pl-2">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <x-label for="preview" value="{{ __('Current presentation') }}" class="pt-3 pb-1"/>
                                <label wire:click="downloadFile" style="cursor: pointer;"
                                       class="flex items-center justify-center w-1/2 h-10 px-4 mt-2 text-xs font-semibold text-white dark:text-gray-800 bg-gray-800 dark:bg-gray-200 rounded-md uppercase cursor-pointer hover:bg-gray-700 dark:hover:bg-white transition focus-within:bg-indigo-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                                    </svg>
                                    Download presentation
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="bg-gray-50 dark:bg-gray-800 mt-5 p-3 pl-2 flex items-center rounded justify-center">
                    <form wire:submit.prevent="save" class="space-y-8 w-full max-w-screen-md">
                        <div class="divide-y divide-gray-200">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <x-label for="photo" value="{{ __('Upload presentation') }}"/>
                                    @if(!Auth::user()->hasRole('content moderator') && !EventInstance::current()->is_final_programme_released)
                                        @if(Auth::user()->speaker->presentation_id == $presentation->id)
                                            <div class="mt-1 flex items-center">
                                                <input type="file" id="file" wire:model="file"
                                                       class="hidden">
                                                <label for="file"
                                                class="flex items-center justify-center w-1/2 h-10 px-4 mt-2 text-xs font-semibold text-white dark:text-gray-800 bg-gray-800 dark:bg-gray-200 rounded-md uppercase cursor-pointer hover:bg-gray-700 dark:hover:bg-white transition focus-within:bg-indigo-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor" class="w-6 h-6 mr-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    @if($presentation->file_path)
                                                        Change file
                                                    @else
                                                        Upload file
                                                    @endif
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                    @if($file && !$errors->has('file') && !session()->has('message'))
                                        <p class="text-gray-500">Uploaded file: {{ $filename }}</p>
                                    @endif
                                    @if (session()->has('message'))
                                        <div class="text-sm text-green-600">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    @error('file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        @if(!Auth::user()->hasRole('content moderator') && !EventInstance::current()->is_final_programme_released)
                            @if(Auth::user()->speaker->presentation_id == $presentation->id && $file && !$errors->has('file') && !session()->has('message'))
                                <div class="flex justify-end">
                                    <button type="submit"
                                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-xs font-semibold text-white dark:text-gray-800 bg-gray-800 dark:bg-gray-200 rounded-md uppercase cursor-pointer hover:bg-gray-700 dark:hover:bg-white transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Save
                                    </button>
                                </div>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

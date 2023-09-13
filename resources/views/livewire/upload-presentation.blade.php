@php use Illuminate\Support\Facades\Auth; @endphp
<div>
    <form wire:submit.prevent="save" class="space-y-8">
        <div class="space-y-8 divide-y divide-gray-200">
            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-6">
                    <x-label for="photo" value="{{ __('Presentation') }}"/>
                    @if ($presentation->file_path)
                        <x-label for="preview" value="{{ __('Current presentation') }}" class="pt-3 pb-1"/>
                        <p wire:click="downloadFile" style="cursor: pointer;">
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
                    @if(!Auth::user()->hasRole('content moderator') && !\App\Models\GlobalEvent::isFinalProgrammeReleased())
                        @if(Auth::user()->speaker->presentation_id == $presentation->id)
                            <div class="mt-1 flex items-center">
                                <input type="file" id="file" wire:model="file"
                                       class="hidden">
                                <label for="file"
                                       class="flex items-center justify-center w-1/3 h-10 px-4 mt-2 text-sm font-medium text-white bg-indigo-600 rounded-md cursor-pointer hover:bg-indigo-700 focus-within:bg-indigo-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                    @if($file && !session()->has('message'))
                        <p class="text-gray-500">{{ $filename }}</p>
                    @endif
                    @error('file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
        @if(!Auth::user()->hasRole('content moderator') && !\App\Models\GlobalEvent::isFinalProgrammeReleased())
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
    </form>
</div>

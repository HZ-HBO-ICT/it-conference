@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Edition;
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
            <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="grid grid-cols-6 gap-6">
                    <!-- Profile Photo -->
                    <div class="col-span-6">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="photo">
                            Presentation
                        </label>

                        <!-- Current Profile Photo -->
                        @if ($presentation->file_path)
                            <div class="mt-2">
                                <label wire:click="downloadFile" style="cursor: pointer;"
                                       class="flex w-1/2 h-7 mt-2 text-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                                    </svg>
                                    Download {{$presentation->file_original_name}}
                                </label>
                            </div>
                        @endif

                        <!-- New Profile Photo Preview -->
                        @if($file && !$errors->has('file') && !session()->has('message'))
                            <div class="mt-2">
                                <p class="text-gray-500 text-sm">Uploaded file: {{ $file->getClientOriginalName() }}</p>
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="text-sm mt-2 text-green-600">
                                {{ session('message') }}
                            </div>
                        @endif
                        @error('file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

                        <form wire:submit.prevent="save" class="space-y-8 w-full max-w-screen-md">
                            <div class="flex flex-wrap">
                                <div class="mt-2 mr-2">
                                    <input type="file" id="file" wire:model="file" class="hidden"
                                           accept="application/pdf, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation"/>
                                    <label for="file"
                                           class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                        Select A New Presentation
                                    </label>
                                </div>
                                <button type="button"
                                        class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 mt-2"
                                        wire:click="delete">
                                    Remove Presentation
                                </button>
                            </div>

                            @can('update', $presentation)
                                @if(Auth::user()->presenter_of->id == $presentation->id && $file && !$errors->has('file') && !session()->has('message'))
                                    <div
                                        class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                        <button type="submit"
                                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-xs font-semibold text-white dark:text-gray-800 bg-gray-800 dark:bg-gray-200 rounded-md uppercase cursor-pointer hover:bg-gray-700 dark:hover:bg-white transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Save
                                        </button>
                                    </div>
                                @endif
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

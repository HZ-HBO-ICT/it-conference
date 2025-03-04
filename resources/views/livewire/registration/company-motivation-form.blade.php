<div>
    <div class="text-center md:text-left text-black dark:text-gray-100 w-full pb-5">
        <h2 class="text-3xl pt-5 font-semibold">Register</h2>
        <h3 class="text-2xl">Company Motivation and Interest</h3>
    </div>
    <div>
        <form wire:submit="goNext" @submit.prevent>
            @csrf
            @if ($errors->any())
                <div class="text-red-500">
                    Oops! There are some issues with the details.
                </div>
            @endif
            <div>
                <div class="mt-4">
                    <x-label for="motivation" value="{{ __('Why would you like to attend?') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <textarea id="motivation" wire:model="motivation"
                              class="h-36 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs block mt-1 w-full"
                              name="motivation" required
                    >{{old('motivation')}}</textarea>
                    <div class="text-red-500 mt-1">@error('motivation') {{ $message }} @enderror</div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <!-- Go back button on the left -->
                    <x-button type="button" wire:click="goBack" class="mb-0.5 mr-4 bg-gray-400">
                        {{ __('Go back') }}
                    </x-button>

                    <!-- Existing content -->
                    <div class="flex items-center justify-end">
                        <x-button type="submit"
                                  class="ml-4 bg-participant-400 dark:bg-participant-400 hover:bg-participant-500 dark:hover:bg-participant-500">
                            {{ __('Next') }}
                        </x-button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

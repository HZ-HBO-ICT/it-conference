<div>
    <div class="text-center md:text-left text-black dark:text-gray-100 w-full pb-5">
        <h2 class="text-3xl pt-5 font-semibold">Register</h2>
        <h3 class="text-2xl">Company details</h3>
    </div>
    <div id="participant">
        <form wire:submit="goNext" @submit.prevent>
            @csrf
            @if ($errors->any())
                <div class="text-red-500">
                    Oops! There are some issues with the details.
                </div>
            @endif
            <div>
                <div class="mt-3">
                    <x-label for="name" value="{{ __('Company name') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="companyName"
                             :value="old('companyName')"
                             required
                             autofocus/>
                    <div class="text-red-500 mt-1">@error('companyName') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-label for="companyDescription" value="{{ __('Company Description') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <textarea id="email" wire:model="companyDescription"
                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                              name="companyDescription" required
                    >{{old('companyDescription')}}</textarea>
                    <div class="text-red-500 mt-1">@error('companyDescription') {{ $message }} @enderror</div>
                </div>


                <div class="mt-4">
                    <x-label for="companyWebsite" value="{{ __('Company Website') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <div class="flex">
                        <span class="flex items-center text-gray-500 border-gray-300 border px-3 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                        rounded-md shadow-sm block mt-1 border-r-0 rounded-r-none">https://</span>
                        <x-input id="company_website" class="block mt-1 w-full rounded-l-none" placeholder="www.example.com" type="text" name="company_website" wire:model="companyWebsite"
                                 required
                        />
                    </div>
                    <div class="text-red-500 mt-1">@error('companyWebsite') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-label for="companyPhoneNumber" value="{{ __('Company Phone Number') }}"/>
                    <x-input id="company_phone_number" class="block mt-1 w-full" type="tel" name="companyPhoneNumber" wire:model="companyPhoneNumber"
                    />
                    <div class="text-red-500 mt-1">@error('companyPhoneNumber') {{ $message }} @enderror</div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <!-- Go back button on the left -->
                    <x-button type="button" wire:click="goBack" class="mb-0.5 mr-4 bg-gray-400">
                        {{ __('Go back') }}
                    </x-button>

                    <!-- Existing content -->
                    <div class="flex items-center justify-end">
                        <x-button type="submit" class="ml-4 bg-participant-400 dark:bg-participant-400 hover:bg-participant-500 dark:hover:bg-participant-500">
                            {{ __('Next') }}
                        </x-button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

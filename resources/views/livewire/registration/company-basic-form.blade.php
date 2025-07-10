<div class="h-fit">
    <div class="text-center md:text-left text-gray-100 w-full pb-5">
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
                    <x-waitt.label for="name" value="{{ __('Company name') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="companyName"
                             :value="old('companyName')"
                             required
                             autofocus/>
                    <div class="text-red-500 mt-1">@error('companyName') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="companyDescription" value="{{ __('Company Description') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input-textarea id="email" wire:model="companyDescription"
                              name="companyDescription" class="w-full" required
                    >{{old('companyDescription')}}</x-waitt.input-textarea>
                    <div class="text-red-500 mt-1">@error('companyDescription') {{ $message }} @enderror</div>
                </div>


                <div class="mt-4">
                    <x-waitt.label for="companyWebsite" value="{{ __('Company Website') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <div class="flex">
                        <span class="flex items-center border-gray-700 border px-3 bg-gray-900 text-gray-700
                        rounded-md shadow-sm block mt-1 border-r-0 rounded-r-none">https://</span>
                        <x-waitt.input id="company_website" class="block mt-1 w-full rounded-l-none"
                                 placeholder="www.example.com" type="text" name="company_website"
                                 wire:model="companyWebsite"
                                 required
                        />
                    </div>
                    <div class="text-red-500 mt-1">@error('companyWebsite') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="companyPhoneNumber"
                             class="after:content-['(optional)'] after:text-gray-500 after:text-sm"
                             value="{{ __('Company Phone Number') }}"/>
                    <livewire:registration.select-country-code/>
                </div>

                <div class="text-red-500 mt-1">@error('companyPhoneNumber') {{ $message }} @enderror</div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <!-- Go back button on the left -->
                <x-waitt.button type="button" wire:click="goBack" class="mb-0.5 mr-4">
                    {{ __('Go back') }}
                </x-waitt.button>

                <!-- Existing content -->
                <div class="flex items-center justify-end">
                    <x-waitt.button type="submit"
                              class="ml-4">
                        {{ __('Next') }}
                    </x-waitt.button>
                </div>
            </div>
        </form>
    </div>
</div>

<div>
    <div class="text-center md:text-left text-gray-100 w-full pb-5">
        <h2 class="text-3xl pt-5 font-semibold">Register</h2>
        <h3 class="text-2xl">Company representative details</h3>
    </div>
    <div id="participant" class="{{is_null(old('company_name')) ? '' : 'hidden'}}">
        <form wire:submit="goNext" @submit.prevent>
            @csrf
            @if ($errors->any())
                <div class="text-red-500">
                    Oops! There are some issues with the details.
                </div>
            @endif
            <div>
                <div class="mt-3">
                    <x-waitt.label for="name" value="{{ __('Full Name') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="name"
                             :value="old('name')"
                             required
                             autofocus autocomplete="name"/>
                    <div class="text-red-500 mt-1">@error('name') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="email" value="{{ __('Email') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="email" class="block mt-1 w-full" type="email" name="email" wire:model="email"
                             :value="old('email')"
                             required
                             autocomplete="username"/>
                    <div class="text-red-500 mt-1">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4" x-data="{showRules:false}">
                    <x-waitt.label for="password" value="{{ __('Password') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="participant-password" class="block mt-1 w-full" type="password" name="password"
                             wire:model="password"
                             required
                             autocomplete="new-password"
                             x-on:focus="showRules = true"
                             x-on:blur="showRules = false"/>

                    <div class="text-red-500 mt-1">@error('password') {{ $message }} @enderror</div>

                    <div x-data="{ password: @entangle('password') }">
                        <div x-show="showRules && password.length > 0"
                             x-text="(password.length < 12 ? '✗' : '✓') + ' The password must be at least 12 characters long.'"
                             :class="{'text-red-500': password.length < 12, 'text-green-500': password.length >= 12}">
                        </div>
                    </div>
                </div>


                <div class="mt-4">
                    <x-waitt.label for="password_confirmation" value="{{ __('Confirm Password') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="password_confirmation" class="block mt-1 w-full" type="password"
                             wire:model="password_confirmation"
                             name="password_confirmation" required autocomplete="new-password"/>
                </div>
                <div class="text-red-500 mt-1">@error('confirmPassword') {{ $message }} @enderror</div>

                <div class="flex items-center justify-end mt-4">
                    <!-- Existing content -->
                    <div>
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                           href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-waitt.button type="submit" class="ml-4">
                            {{ __('Next') }}
                        </x-waitt.button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

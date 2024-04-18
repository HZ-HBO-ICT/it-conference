<div id="company" class="{{is_null(old('company_name')) ? 'hidden' : ''}}">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h3 class="text-lg text-black dark:text-gray-100 font-semibold pt-4">Company representative details</h3>
        <div class="grid gap-x-6 grid-cols-1 sm:grid-cols-2">
            <div class="mt-2">
                <x-label for="name" value="{{ __('Full Name') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                         :value="old('name')"
                         required
                         autofocus autocomplete="name"/>
            </div>

            <div class="mt-2">
                <x-label for="email" value="{{ __('Email') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email')"
                         required
                         autocomplete="username"/>
            </div>

            <div class="mt-3">
                <x-label for="password" value="{{ __('Password') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="company-password" class="password block mt-1 w-full" type="password" name="password"
                         required
                         autocomplete="new-password"/>

                <div id="company-password-rules"
                     class="password-rules hidden text-sm text-gray-700 dark:text-gray-300 mt-2 pl-2">
                    <p>Password should be of the following format:</p>
                    <ul class="pl-5 pt-0.5">
                        <li>
                            <p id="company-length-false" class="before:content-['✗_'] text-red-500">length
                                                                                                    is at
                                                                                                    least 12
                                                                                                    characters</p>

                            <p id="company-length-true" class="hidden before:content-['✓_'] text-green-500">
                                length
                                is at
                                least 12
                                characters</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-3">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password"/>
            </div>
        </div>
        <h3 class="text-lg text-black dark:text-gray-100 font-semibold pt-5">Company details</h3>
        <div id="company" class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
            <div class="mt-2">
                <x-label for="company_name" value="{{ __('Company Name') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="company_name" class="block mt-1 w-full" type="text"
                         name="company_name"
                         :value="old('company_name')" required
                         autofocus autocomplete="name"/>
            </div>

            <div class="mt-2">
                <x-label for="company_phone_number" value="{{ __('Phone number') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="company_phone_number" class="block mt-1 w-full" type="tel"
                         name="company_phone_number"
                         :value="old('company_phone_number')" required
                         autofocus autocomplete="phone_number"/>
            </div>


            <div class="mt-3 col-span-1 sm:col-span-2">
                <x-label for="company_description" value="{{ __('Company Description') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <textarea id="email"
                          class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                          name="company_description" required
                >{{old('company_description')}}</textarea>
            </div>

            <div class="mt-2 col-span-1 sm:col-span-2">
                <x-label for="company_website" value="{{ __('Website') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="company_website" class="block mt-1 w-full" type="url"
                         name="company_website"
                         required
                         autocomplete="company_website" :value="old('company_website')"/>
            </div>

            <div class="mt-3">
                <x-label for="company_postcode" value="{{ __('Postcode') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <p class="text-xs text-gray-600 dark:text-gray-400">Format: 1234AB</p>
                <x-input id="company_postcode" class="block mt-1 w-full" type="text"
                         name="company_postcode"
                         :value="old('company_postcode')" required
                         oninput="this.value = this.value.toUpperCase()"
                         autofocus autocomplete="postcode"/>
            </div>

            <div class="flex items-end">
                <div class="w-full">
                    <x-label for="company_street" value="{{ __('Street') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-input id="company_street" class="block mt-1 w-full" type="text"
                             name="company_street"
                             :value="old('company_street')" required
                             autofocus autocomplete="name"/>
                </div>
            </div>

            <div class="mt-3">
                <x-label for="company_house_number" value="{{ __('House Number') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="company_house_number" class="block mt-1 w-full" type="text"
                         name="company_house_number"
                         :value="old('company_house_number')" required
                         autofocus autocomplete="name"/>
            </div>

            <div class="mt-3">
                <x-label for="company_city" value="{{ __('City') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="company_city" class="block mt-1 w-full" type="text"
                         name="company_city"
                         :value="old('company_city')" required
                         autofocus autocomplete="name"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </div>
    </form>
</div>

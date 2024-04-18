<div id="participant" class="{{is_null(old('company_name')) ? '' : 'hidden'}}">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <div class="mt-3">
                <x-label for="name" value="{{ __('Full Name') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                         :value="old('name')"
                         required
                         autofocus autocomplete="name"/>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email')"
                         required
                         autocomplete="username"/>
            </div>

            <div class="mt-4">
                <x-label for="institution" value="{{ __('Institution') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="institution" class="block mt-1 w-full" type="text"
                         name="institution"
                         :value="old('institution')" required
                         autofocus autocomplete="institution"/>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="participant-password" class="block mt-1 w-full" type="password" name="password"
                         required
                         autocomplete="new-password"/>

                <div id="participant-password-rules"
                     class="password-rules hidden text-sm text-gray-700 dark:text-gray-300 mt-2 pl-2">
                    <p>Password should be of the following format:</p>
                    <ul class="pl-5 pt-0.5">
                        <li>
                            <p id="participant-length-false" class="before:content-['✗_'] text-red-500">length
                                                                                            is at
                                                                                            least 12
                                                                                            characters</p>

                            <p id="participant-length-true" class="hidden before:content-['✓_'] text-green-500">
                                length
                                is at
                                least 12
                                characters</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"
                         class="after:content-['*'] after:text-red-500"/>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password"/>
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

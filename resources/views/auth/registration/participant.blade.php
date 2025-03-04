<x-app-layout>
    <div class="py-0 md:py-10 lg:py-20 h-fit md:h-auto flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-0 sm:px-20 lg:px-40">
        <div class="grid grid-cols-1 md:grid-cols-7 w-full bg-white dark:bg-gray-800 rounded-md">
            <div id="pretty-slide" class="h-full col-span-3 hidden md:flex rounded-md">
                <div class="h-full rounded-md overflow-hidden">
                    <div class="relative h-full w-full">
                        <img class="h-full w-full object-cover" src="/img/market.jpg" alt="market">
                        <div class="gradient absolute inset-0" style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
                        <div class="absolute inset-0 flex justify-center items-center z-10">
                            <h2 class="text-4xl font-bold text-white drop-shadow-md text-center leading-tight">We are in IT together<br>Conference</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div id="form-slide" class="col-span-4 h-full w-full px-12 py-2 flex justify-center items-center">
                <div class="w-full h-full flex items-center justify-center">
                    <div class="text-center md:text-left text-black dark:text-gray-100 w-full pb-5">
                        <h2 class="text-3xl pt-5 font-semibold">Participant Registration</h2>
                        <div class="w-full text-left">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <x-validation-errors class="pt-4" />
                                <input class="hidden" name="registration_type" value="participant">
                                <div class="mt-5">
                                    <x-label for="name" value="{{ __('Full Name') }}" class="after:content-['*'] after:text-red-500" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <div class="text-red-500 mt-1">@error('name') {{ $message }} @enderror</div>
                                </div>

                                <div class="mt-4">
                                    <x-label for="email" value="{{ __('Email') }}" class="after:content-['*'] after:text-red-500" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <div class="text-red-500 mt-1">@error('email') {{ $message }} @enderror</div>
                                </div>

                                <div class="mt-4">
                                    <x-label for="institution" value="{{ __('Institution') }}" class="after:content-['*'] after:text-red-500" />
                                    <x-input id="institution" class="block mt-1 w-full" type="text" name="institution" :value="old('institution')" required autofocus />
                                    <div class="text-red-500 mt-1">@error('institution') {{ $message }} @enderror</div>
                                </div>

                                <div class="mt-4">
                                    <x-label for="password" value="{{ __('Password') }}" class="after:content-['*'] after:text-red-500" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                    <div class="text-red-500 mt-1">@error('password') {{ $message }} @enderror</div>
                                    <div id="password-rules" class="hidden text-sm text-gray-700 dark:text-gray-300 mt-2 pl-2">
                                        <p>Password should be of the following format:</p>
                                        <ul class="pl-5 pt-0.5">
                                            <li>
                                                <p id="length-false" class="before:content-['✗_'] text-red-500">length is at least 12 characters</p>
                                                <p id="length-true" class="hidden before:content-['✓_'] text-green-500">length is at least 12 characters</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="after:content-['*'] after:text-red-500" />
                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="mt-4">
                                        <x-label for="terms">
                                            <div class="flex items-center">
                                                <x-checkbox name="terms" id="terms" required />
                                                <div class="ml-2">
                                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Terms of Service') . '</a>',
                                                        'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' . __('Privacy Policy') . '</a>',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </x-label>
                                    </div>
                                @endif

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                    <x-button type="submit" class="ml-4 bg-participant-400 dark:bg-participant-400 hover:bg-participant-500 dark:hover:bg-participant-500">
                                        {{ __('Register') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="/js/registration-validation.js"></script>

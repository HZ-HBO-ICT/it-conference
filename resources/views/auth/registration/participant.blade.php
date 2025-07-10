<x-app-layout>
    <div class="h-screen relative overflow-hidden mx-auto px-4 pt-14 pb-24">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-24 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
            <div
                class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/5 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
            <div
                class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-24 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        </div>

        <div class="relative h-full flex items-center justify-center max-w-7xl mx-auto px-4">
            <div
                class="grid grid-cols-1 md:grid-cols-7 h-full w-full max-w-6xl rounded-xl border border-slate-900 overflow-hidden shadow-lg">
                <div class="hidden md:block md:col-span-3">
                    <div class="relative h-full">
                        <img class="w-full h-full object-cover" src="/img/market-scaled.webp" alt="market"/>
                        <div class="absolute inset-0 bg-gradient-to-br from-waitt-yellow/70 via-waitt-cyan/50 to-waitt-pink/30"></div>
                        <div class="absolute inset-0 bg-black/60"></div>
                        <div class="absolute inset-0 flex items-center justify-center px-6">
                            <img src="{{asset('/img/waitt25/light-full-logo.png')}}">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-4 bg-waitt-dark/70 backdrop-blur-sm px-8 pt-5 sm:px-12">
                    <div class="text-center md:text-left text-gray-100 w-full pb-5">
                        <h2 class="text-2xl font-semibold">Participant Registration</h2>
                        <div class="w-full text-left">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <x-validation-errors class="pt-4"/>
                                <input class="hidden" name="registration_type" value="participant">
                                <div class="mt-5">
                                    <x-waitt.label for="name" value="{{ __('Full Name') }}"
                                                   class="after:content-['*'] after:text-red-500"/>
                                    <x-waitt.input id="name" class="block mt-1 w-full" type="text" name="name"
                                                   :value="old('name')" required autofocus autocomplete="name"/>
                                    <div class="text-red-500 mt-1">@error('name') {{ $message }} @enderror</div>
                                </div>

                                <div class="mt-4">
                                    <x-waitt.label for="email" value="{{ __('Email') }}"
                                                   class="after:content-['*'] after:text-red-500"/>
                                    <x-waitt.input id="email" class="block mt-1 w-full" type="email" name="email"
                                                   :value="old('email')" required autocomplete="username"/>
                                    <div class="text-red-500 mt-1">@error('email') {{ $message }} @enderror</div>
                                </div>

                                <div class="mt-4">
                                    <x-waitt.label for="institution" value="{{ __('Institution') }}"
                                                   class="after:content-['*'] after:text-red-500"/>
                                    <x-waitt.input id="institution" class="block mt-1 w-full" type="text"
                                                   name="institution" :value="old('institution')" required autofocus/>
                                    <div
                                        class="text-red-500 mt-1">@error('institution') {{ $message }} @enderror</div>
                                </div>

                                <div class="mt-4">
                                    <x-waitt.label for="password" value="{{ __('Password') }}"
                                                   class="after:content-['*'] after:text-red-500"/>
                                    <x-waitt.input id="password" class="block mt-1 w-full" type="password" name="password"
                                                   required autocomplete="new-password"/>
                                    <div class="text-red-500 mt-1">@error('password') {{ $message }} @enderror</div>
                                    <div id="password-rules"
                                         class="hidden text-sm text-gray-700 dark:text-gray-300 mt-2 pl-2">
                                        <p>Password should be of the following format:</p>
                                        <ul class="pl-5 pt-0.5">
                                            <li>
                                                <p id="length-false" class="before:content-['✗_'] text-red-500">
                                                    length is at least 12 characters</p>
                                                <p id="length-true"
                                                   class="hidden before:content-['✓_'] text-green-500">length is at
                                                    least 12 characters</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <x-waitt.label for="password_confirmation" value="{{ __('Confirm Password') }}"
                                                   class="after:content-['*'] after:text-red-500"/>
                                    <x-waitt.input id="password_confirmation" class="block mt-1 w-full" type="password"
                                                   name="password_confirmation" required autocomplete="new-password"/>
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="mt-4">
                                        <x-label for="terms">
                                            <div class="flex items-center">
                                                <x-waitt.checkbox name="terms" id="terms" required/>
                                                <div class="ml-2 text-gray-300">
                                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800">' . __('Terms of Service') . '</a>',
                                                        'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800">' . __('Privacy Policy') . '</a>',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </x-label>
                                    </div>
                                @endif

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800"
                                       href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                    <x-waitt.button type="submit"
                                                    class="ml-4">
                                        {{ __('Register') }}
                                    </x-waitt.button>
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

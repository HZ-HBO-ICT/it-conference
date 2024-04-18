<x-app-layout>
    <div class="py-20 flex items-center justify-center bg-gray-200 px-40">
        <div class="grid grid-cols-7 bg-white rounded-md">
            <div class="col-span-4 h-full">
                <x-slideshows.login></x-slideshows.login>
            </div>
            <div class="col-span-3 px-12 py-32">
                <div>
                    <h1 class="text-3xl font-semibold">Welcome back!</h1>
                    <h1 class="text-base pb-8">Enter your credentials to log in.</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <x-label for="email" value="{{ __('Email') }}"/>
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                     :value="old('email')"
                                     required autofocus autocomplete="username"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}"/>
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                     autocomplete="current-password"/>
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember"/>
                                <span
                                    class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                   href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-button class="ml-4">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

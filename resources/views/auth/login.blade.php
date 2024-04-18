<x-app-layout>
    <div class="md:py-20 h-screen md:h-auto flex items-center justify-center bg-gray-200 md:px-40">
        <div class="grid grid-cols-7 bg-white rounded-md">
            <div class="col-span-4 h-full hidden md:block">
                <x-slideshows.login></x-slideshows.login>
            </div>
            <div class="col-span-7 md:col-span-3 px-12 py-28 ">
                <div>
                    <div class="text-center md:text-left">
                        <h1 class="text-4xl font-bold block md:hidden">We are in IT together</h1>
                        <h2 class="text-3xl pt-5 font-semibold">Welcome back!</h2>
                        <h3 class="text-base pb-8">Enter your credentials to log in.</h3>
                    </div>
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

                        <div class="flex flex-col md:flex-row items-center md:justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-md text-gray-600 md:pr-3 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 md:order-none order-2"
                                   href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                            <x-button class="mb-2 md:mb-0 md:mr-4 md:order-none order-1">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

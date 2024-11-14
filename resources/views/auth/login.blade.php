<x-app-layout>
    <div class="py-0 md:py-10 lg:py-20 h-screen md:h-auto flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-0 sm:px-20 lg:px-40">
        <div class="grid grid-cols-7 bg-white dark:bg-gray-800 rounded-md">
            <div class="col-span-4 h-full hidden md:block">
                <div class="h-full rounded-md" style="overflow: clip">
                    <div class="relative h-full">
                        <img class="h-full object-cover" src="/img/market.webp" alt="market">
                        <div class="gradient absolute inset-0"
                             style="background: linear-gradient(to bottom right, rgba(54, 102, 255, 0.7), rgba(184, 98, 214, 0.7));"></div>
                        <div class="absolute inset-0 flex justify-center items-center" style="z-index: 3">
                            <h2 class="text-5xl font-bold text-white drop-shadow-md text-center leading-tight">We are in IT together<br>Conference</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-7 md:col-span-3 px-12 py-28 ">
                <div>
                    <div class="text-center md:text-left text-black dark:text-gray-100">
                        <h1 class="text-4xl font-bold block md:hidden">We are in IT together</h1>
                        <h2 class="text-3xl pt-5 font-semibold">Welcome back!</h2>
                        <h3 class="text-base pb-5">Enter your credentials to log in.</h3>
                        <div class="text-red-500 pb-2">
                            @if($errors->any())
                                {{ implode('', $errors->all(':message')) }}
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <x-label for="email" value="{{ __('Email') }}"/>
                            <x-input id="email" class="block mt-1 w-full @error('email') is-invalid @enderror" type="email" name="email"
                                     :value="old('email')"
                                     required autofocus autocomplete="username"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}"/>
                            <x-input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password" name="password" required
                                     autocomplete="current-password"/>
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember"/>
                                <span
                                    class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex flex-col md:flex-row items-center md:justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm md:text-md text-gray-600 md:pr-3 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 md:order-none order-2"
                                   href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                            <x-button class="mb-2 text-sm lg:text-md md:mb-0 md:mr-4 md:order-none order-1">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

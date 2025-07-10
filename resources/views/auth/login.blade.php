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
                class="grid grid-cols-1 md:grid-cols-7 w-full max-w-6xl rounded-xl border border-slate-900 overflow-hidden shadow-lg">
                <div class="hidden md:block md:col-span-4">
                    <div class="relative h-full">
                        <img class="w-full h-full object-cover" src="/img/market-scaled.webp" alt="market"/>
                        <div class="absolute inset-0 bg-gradient-to-br from-waitt-yellow/70 via-waitt-cyan/50 to-waitt-pink/30"></div>
                        <div class="absolute inset-0 bg-black/60"></div>
                        <div class="absolute inset-0 flex items-center justify-center px-6">
                            <img class="h-42" src="{{asset('/img/waitt25/light-full-logo.png')}}">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 bg-waitt-dark/70 backdrop-blur-sm px-8 py-20 sm:px-12">
                    <div class="text-gray-100 text-center md:text-left">
                        <h1 class="text-3xl md:hidden font-bold">We are in IT together</h1>
                        <h2 class="text-2xl mt-4 font-semibold">Welcome back</h2>
                        <p class="text-sm text-gray-400 mt-1 mb-6">Enter your credentials to log in</p>

                        @if($errors->any())
                            <div class="text-red-500 text-sm mb-4">
                                {{ implode('', $errors->all(':message')) }}
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div>
                            <x-waitt.label for="email" value="{{ __('Email') }}" class="text-sm text-gray-300"/>
                            <x-waitt.input id="email" class="block mt-1 w-full @error('email') is-invalid @enderror" type="email" name="email"
                                     :value="old('email')"
                                     required autofocus autocomplete="username"/>
                        </div>

                        <div>
                            <x-waitt.label for="password" value="{{ __('Password') }}" class="text-sm text-gray-300"/>
                            <x-waitt.input id="password" class="block mt-1 w-full @error('password') is-invalid @enderror" type="password" name="password" required
                                     autocomplete="current-password"/>
                        </div>

                        <div class="flex items-center">
                            <x-waitt.checkbox id="remember_me" name="remember"/>
                            <label for="remember_me" class="ml-2 text-sm text-gray-300">
                                {{ __('Remember me') }}
                            </label>
                        </div>

                        <div class="flex flex-col md:flex-row items-center justify-between mt-6 space-y-3 md:space-y-0">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm text-waitt-pink hover:text-pink-700 transition duration-150 ease-in-out">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-waitt.button class="w-full md:w-auto transition-all">
                                {{ __('Log in') }}
                            </x-waitt.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

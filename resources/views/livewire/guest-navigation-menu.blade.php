<nav x-data="{ open: false }"
     class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700 relative z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <!-- Leaving it just in case we get logo -->
                {{--<div class="shrink-0 flex items-center">
                    <x-home-link href="{{ route('welcome') }}" class="text-center"
                                 :active="request()->routeIs('welcome')">
                        {{ __('We are in IT together') }}<br>{{ __('conference') }}
                    </x-home-link>
                </div>--}}

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('speakers.index') }}" :active="request()->routeIs('speakers.index')">
                        {{ __('Speakers') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('companies.index') }}" :active="request()->routeIs('companies.index')">
                        {{ __('Companies') }}
                    </x-nav-link>
                </div>
                {{--
                @if(\App\Models\EventInstance::current()->is_final_programme_released)
                    <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                        <x-nav-link href="{{ route('programme') }}" :active="request()->routeIs('programme')">
                            {{ __('Programme') }}
                        </x-nav-link>
                    </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')">
                        {{ __('FAQ') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>--}}
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Login and Register Links -->
                {{--<x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>
                <div class="pl-2">
                    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                </div>--}}
                <div class="pl-4">
                    <svg onclick="changeTheme()" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgb(107 114 128)"
                         class="bi bi-circle-half" viewBox="0 0 16 16" style="cursor: pointer;">
                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                    </svg>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('speakers.index') }}" :active="request()->routeIs('speakers.index')">
                {{ __('Speakers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('companies.index') }}" :active="request()->routeIs('companies.index')">
                {{ __('Companies') }}
            </x-responsive-nav-link>
            {{--
            @if(\App\Models\EventInstance::current()->is_final_programme_released)
                <x-responsive-nav-link href="{{ route('programme') }}" :active="request()->routeIs('programme')">
                    {{ __('Programme') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')">
                {{ __('FAQ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
            <div class="border-t border-gray-200 dark:border-gray-600"></div>
            <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                {{ __('Register') }}
            </x-responsive-nav-link>--}}
            <x-responsive-nav-link onclick="changeTheme()">
                Change theme
            </x-responsive-nav-link>
        </div>
    </div>
</nav>

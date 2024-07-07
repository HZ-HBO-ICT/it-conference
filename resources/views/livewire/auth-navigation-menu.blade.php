@php
    use \App\Models\Edition;
@endphp

<nav x-data="{ open: false }"
     class="relative z-10">
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
                    <x-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')" wire:navigate.hover>
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('speakers.index') }}" :active="request()->routeIs('speakers.index')" wire:navigate.hover>
                        {{ __('Speakers') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('companies.index') }}" :active="request()->routeIs('companies.index')" wire:navigate.hover>
                        {{ __('Companies') }}
                    </x-nav-link>
                </div>
                @if(Edition::current() && Edition::current()->is_final_programme_released)
                    <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                        <x-nav-link href="{{ route('programme') }}" :active="request()->routeIs('programme')" wire:navigate.hover>
                            {{ __('Programme') }}
                        </x-nav-link>
                    </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')" wire:navigate.hover>
                        {{ __('FAQ') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')" wire:navigate.hover>
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @if(Auth::user()->currentTeam && Auth::user()->currentTeam->owner->id == Auth::user()->id)
                    <span
                        class="inline-flex py-1 pr-2 rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                        <a href="{{route('announcements')}}" wire:navigate.hover
                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md">
                            {{ Auth::user()->currentTeam->name }}
                        </a>
                        <div
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            @if(Auth::user()->currentTeam->logo_path)
                                <img class="h-8 w-8 rounded-full object-cover"
                                     src="{{ url('storage/'. Auth::user()->currentTeam->logo_path) }}"
                                     alt="{{ Auth::user()->currentTeam->name }}"/>
                            @endif
                        </div>
                    </span>
                @else
                    <span
                        class="inline-flex py-1 pr-2 rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                        <a href="{{ route('dashboard') }}" wire:navigate.hover
                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md">
                            {{ Auth::user()->name }}
                        </a>
                        <div
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover"
                                 src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                        </div>
                    </span>
                @endif
                    <div class="pl-4">
                        <div>
                            <div class="flex-shrink-0 hidden w-[38px] overflow-hidden rounded-full h-[38px] sm:block">
                                <button x-data="{
                                        darkMode: $persist(false).as('dark_mode'),
                                        toggleDarkMode(){
                                            this.darkMode = !this.darkMode;
                                            if(this.darkMode){
                                                document.documentElement.classList.add('dark');
                                            } else {
                                                document.documentElement.classList.remove('dark');
                                            }
                                        }
                                    }"
                                        @click="toggleDarkMode()"
                                        x-init="darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')"
                                        class="w-full h-full flex items-center justify-center hover:bg-gray-100 text-gray-500 hover:text-gray-600 dark:hover:bg-gray-800 dark:text-gray-300 dark:hover:text-gray-100">
                                    <svg class="w-4 h-4 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
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
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link wire:navigate.hover href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:navigate.hover href="{{ route('speakers.index') }}" :active="request()->routeIs('speakers.index')">
                {{ __('Speakers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:navigate.hover href="{{ route('companies.index') }}"
                                   :active="request()->routeIs('companies.index')">
                {{ __('Companies') }}
            </x-responsive-nav-link>
            @if(Edition::current() && Edition::current()->is_final_programme_released)
                <x-responsive-nav-link {{--href="{{ route('programme') }}" :active="request()->routeIs('programme')"--}}>
                    {{ __('Programme') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link wire:navigate.hover href="{{ route('faq') }}" :active="request()->routeIs('faq')">
                {{ __('FAQ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link wire:navigate.hover href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
            <div class="border-t border-gray-200 dark:border-gray-600"></div>
            <x-responsive-nav-link wire:navigate.hover href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __(Auth::user()->name) }}
            </x-responsive-nav-link>
            <div class="border-t border-gray-200 dark:border-gray-600"></div>
            <x-responsive-nav-link x-data="{
                                        darkMode: $persist(false).as('dark_mode'),
                                        toggleDarkMode(){
                                            this.darkMode = !this.darkMode;
                                            if(this.darkMode){
                                                document.documentElement.classList.add('dark');
                                            } else {
                                                document.documentElement.classList.remove('dark');
                                            }
                                        }
                                    }"
                                   @click="toggleDarkMode()"
                                   x-init="darkMode ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')">
                Change theme
            </x-responsive-nav-link>
        </div>
    </div>
</nav>

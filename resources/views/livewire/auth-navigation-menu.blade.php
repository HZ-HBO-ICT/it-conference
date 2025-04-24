@php
    use \App\Models\Edition;

    $edition = Edition::current();
@endphp

<nav x-data="{ open: false }" class="relative z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('img/logo-small-participant.png') }}" alt="IT Conference" class="w-full h-full object-contain">
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('welcome') }}" 
                   class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 transition-all duration-200 {{ request()->routeIs('welcome') ? 'text-blue-600 bg-blue-50/50 font-medium' : '' }}"
                   wire:navigate.hover>
                    {{ __('Home') }}
                </a>
                @if($edition)
                    <a href="{{ route('speakers.index') }}" 
                       class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 transition-all duration-200 {{ request()->routeIs('speakers.index') ? 'text-blue-600 bg-blue-50/50 font-medium' : '' }}"
                       wire:navigate.hover>
                        {{ __('Speakers') }}
                    </a>
                    <a href="{{ route('companies.index') }}" 
                       class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 transition-all duration-200 {{ request()->routeIs('companies.index') ? 'text-blue-600 bg-blue-50/50 font-medium' : '' }}"
                       wire:navigate.hover>
                        {{ __('Companies') }}
                    </a>
                @endif
                @if(optional($edition)->is_final_programme_released)
                    <a href="{{ route('programme') }}" 
                       class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 transition-all duration-200 {{ request()->routeIs('programme') ? 'text-blue-600 bg-blue-50/50 font-medium' : '' }}"
                       wire:navigate.hover>
                        {{ __('Programme') }}
                    </a>
                @endif
                <a href="{{ route('faq') }}" 
                   class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 transition-all duration-200 {{ request()->routeIs('faq') ? 'text-blue-600 bg-blue-50/50 font-medium' : '' }}"
                   wire:navigate.hover>
                    {{ __('FAQ') }}
                </a>
                <a href="{{ route('contact') }}" 
                   class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 transition-all duration-200 {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50/50 font-medium' : '' }}"
                   wire:navigate.hover>
                    {{ __('Contact') }}
                </a>
            </div>

            <!-- Right side buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- User Menu -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-200">
                            <span class="text-gray-700 dark:text-gray-300 font-medium">{{ Auth::user()->name }}</span>
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>
                        <x-dropdown-link href="{{ route('dashboard') }}" wire:navigate.hover class="flex items-center space-x-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>{{ __('My hub') }}</span>
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate.hover class="flex items-center space-x-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>{{ __('Profile') }}</span>
                        </x-dropdown-link>
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="flex items-center space-x-2 text-red-600 dark:text-red-400">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                <span>{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

                <!-- Theme Toggle -->
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
                class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-200">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="open = ! open" 
                        class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-200">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" 
                              class="inline-flex" 
                              stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" 
                              class="hidden" 
                              stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" 
         class="md:hidden absolute w-full bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-t border-gray-200 dark:border-gray-700">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('welcome') }}" 
               class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('welcome') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
               wire:navigate.hover>
                {{ __('Home') }}
            </a>
            @if($edition)
                <a href="{{ route('speakers.index') }}" 
                   class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('speakers.index') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
                   wire:navigate.hover>
                    {{ __('Speakers') }}
                </a>
                <a href="{{ route('companies.index') }}" 
                   class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('companies.index') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
                   wire:navigate.hover>
                    {{ __('Companies') }}
                </a>
            @endif
            @if(optional($edition)->is_final_programme_released)
                <a href="{{ route('programme') }}" 
                   class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('programme') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
                   wire:navigate.hover>
                    {{ __('Programme') }}
                </a>
            @endif
            <a href="{{ route('faq') }}" 
               class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('faq') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
               wire:navigate.hover>
                {{ __('FAQ') }}
            </a>
            <a href="{{ route('contact') }}" 
               class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('contact') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
               wire:navigate.hover>
                {{ __('Contact') }}
            </a>
            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
            <a href="{{ route('dashboard') }}" 
               class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
               wire:navigate.hover>
                {{ __('My hub') }}
            </a>
            <a href="{{ route('profile.show') }}" 
               class="block px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50/50 dark:hover:bg-blue-900/50 transition-all duration-200 {{ request()->routeIs('profile.show') ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/50 font-medium' : '' }}"
               wire:navigate.hover>
                {{ __('Profile') }}
            </a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" 
                        class="w-full text-left px-4 py-2 rounded-lg text-red-600 dark:text-red-400 hover:bg-red-50/50 dark:hover:bg-red-900/50 transition-all duration-200">
                    {{ __('Log Out') }}
                </button>
            </form>
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
            class="w-full mt-2 px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all duration-200 flex items-center justify-center">
                <span class="mr-2">Change theme</span>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/>
                </svg>
            </button>
        </div>
    </div>
</nav>

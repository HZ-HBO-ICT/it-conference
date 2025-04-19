@php
    use \App\Models\Edition;

    $edition = Edition::current();
@endphp

<nav x-data="{ open: false }" class="relative z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo and Brand -->
            <div class="flex items-center">
                <a href="{{ route('welcome') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('img/logo-small-participant.png') }}" alt="IT Conference" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <div class="text-lg font-bold bg-gradient-to-r from-blue-600 to-teal-500 bg-clip-text text-transparent">
                            IT Conference
                        </div>
                        <div class="text-xs text-gray-500">2025 Edition</div>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('welcome') }}" 
                   class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 transition-all duration-200 {{ request()->routeIs('welcome') ? 'text-blue-600 bg-blue-50/50 font-medium' : '' }}">
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
                <!-- Login Button -->
                <a href="{{ route('login') }}" 
                   class="bubble-button px-6 py-2.5 rounded-lg bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-purple-100 to-transparent text-[#0b253f] font-medium hover:shadow-[0_0_15px_rgba(147,51,234,0.5)] transition-all duration-300 shadow-[0_0_10px_rgba(147,51,234,0.3)] hover:-translate-y-0.5">
                    {{ __('Login') }}
                </a>

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
            <a href="{{ route('login') }}" 
               class="block px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-teal-500 text-white font-medium hover:from-blue-700 hover:to-teal-600 transition-all duration-200">
                {{ __('Login') }}
            </a>
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

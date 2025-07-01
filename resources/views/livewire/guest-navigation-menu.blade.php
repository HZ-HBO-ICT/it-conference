@php
    use \App\Models\Edition;

    $edition = Edition::current();
@endphp

<nav x-data="{ open: false }"
     class="relative z-10 w-full">
    <!-- Primary Navigation Menu -->
    <div class="w-full max-w-7xl mx-auto">
        <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8" style="background:rgba(7,14,28,0.95);">
            <div class="flex items-center flex-shrink-0">
                <img src="{{ asset('/img/waitt25/logo.webp') }}" alt="WAITT Logo" class="h-6 w-auto max-w-full" />
            </div>

            <div class="hidden ml-8 md:flex flex-1 gap-4 lg:gap-6">
                <a href="{{ route('welcome') }}" wire:navigate.hover class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Home</a>
                @if($edition)
                    <a href="{{ route('speakers.index') }}" wire:navigate.hover class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('speakers.index') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Speakers</a>
                    <a href="{{ route('companies.index') }}" wire:navigate.hover class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('companies.index') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Companies</a>
                @endif
                @if(optional($edition)->is_final_programme_released)
                    <a href="{{ route('programme') }}" wire:navigate.hover class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('programme') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Programme</a>
                @endif
                <a href="{{ route('faq') }}" wire:navigate.hover class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('faq') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" wire:navigate.hover class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Contact</a>
            </div>
            <!-- Login on the right -->
            <div class="hidden md:flex pr-2">
                <a href="{{ route('login') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('login') ? 'text-brand-yellow font-bold' : '' }}">Login</a>
            </div>
            <!-- Hamburger -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
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

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="bg-[rgba(7,14,28,0.95)] shadow-lg">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('welcome') }}" class="block px-3 py-2 text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-brand-yellow font-bold bg-gray-800 border-l-4 border-brand-yellow' : '' }}">Home</a>
                <a href="{{ route('speakers.index') }}" class="block px-3 py-2 text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('speakers.index') ? 'text-brand-yellow font-bold bg-gray-800 border-l-4 border-brand-yellow' : '' }}">Speakers</a>
                <a href="{{ route('programme') }}" class="block px-3 py-2 text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('programme') ? 'text-brand-yellow font-bold bg-gray-800 border-l-4 border-brand-yellow' : '' }}">Presentations</a>
                <a href="{{ route('companies.index') }}" class="block px-3 py-2 text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('companies.index') ? 'text-brand-yellow font-bold bg-gray-800 border-l-4 border-brand-yellow' : '' }}">Companies</a>
                <a href="{{ route('faq') }}" class="block px-3 py-2 text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('faq') ? 'text-brand-yellow font-bold bg-gray-800 border-l-4 border-brand-yellow' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-brand-yellow font-bold bg-gray-800 border-l-4 border-brand-yellow' : '' }}">Contact</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('login') ? 'text-brand-yellow font-bold bg-gray-800 border-l-4 border-brand-yellow' : '' }}">Login</a>
            </div>
        </div>
    </div>
</nav>

@php
    use \App\Models\Edition;

    $edition = Edition::current();
@endphp

<nav x-data="{ open: false }" class="w-full bg-transparent shadow-none border-none">
    <div class="max-w-full mx-auto">
        <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8" style="background:rgba(7,14,28,0.95);">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <span class="text-xl sm:text-2xl font-extrabold text-brand-yellow">WAITT25</span>
            </div>
            <!-- Centered Nav Links -->
            <div class="hidden md:flex flex-1 justify-center gap-4 lg:gap-6">
                <a href="{{ route('welcome') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Home</a>
                <a href="{{ route('speakers.index') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('speakers.index') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Speakers</a>
                <a href="{{ route('programme') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('programme') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Presentations</a>
                <a href="{{ route('companies.index') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('companies.index') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Companies</a>
                <a href="{{ route('faq') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('faq') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-brand-yellow font-bold underline underline-offset-8' : '' }}">Contact</a>
            </div>
            <!-- Login on the right -->
            <div class="hidden md:flex items-center ml-4 lg:ml-8">
                <a href="{{ route('login') }}" class="text-sm lg:text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('login') ? 'text-brand-yellow font-bold' : '' }}">Login</a>
            </div>
            <!-- Hamburger -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <svg class="h-6 w-6" x-show="!open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-show="open" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1">
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

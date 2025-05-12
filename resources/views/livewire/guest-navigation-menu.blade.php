@php
    use \App\Models\Edition;

    $edition = Edition::current();
@endphp

<nav x-data="{ open: false }" class="w-full bg-transparent shadow-none border-none">
    <div class="max-w-full mx-auto">
        <div class="flex items-center justify-between h-16 px-8" style="background:rgba(7,14,28,0.95);">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <img src="/img/logo-small-apricot-peach.png" alt="IT Conference Logo" class="h-9 w-auto" />
            </div>
            <!-- Centered Nav Links -->
            <div class="flex-1 flex justify-center gap-12">
                <a href="{{ route('welcome') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-[#FFFF3C] font-bold' : '' }}">Home</a>
                <a href="{{ route('speakers.index') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('speakers.index') ? 'text-[#FFFF3C] font-bold' : '' }}">Speakers</a>
                <a href="{{ route('programme') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('programme') ? 'text-[#FFFF3C] font-bold' : '' }}">Presentations</a>
                <a href="{{ route('companies.index') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('companies.index') ? 'text-[#FFFF3C] font-bold' : '' }}">Companies</a>
                <a href="{{ route('faq') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('faq') ? 'text-[#FFFF3C] font-bold' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-[#FFFF3C] font-bold' : '' }}">Contact</a>
            </div>
            <!-- Login on the right -->
            <div class="flex items-center ml-8">
                <a href="{{ route('login') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('login') ? 'text-[#FFFF3C] font-bold' : '' }}">Login</a>
            </div>
        </div>
    </div>
</nav>

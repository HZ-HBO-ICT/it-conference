@php
    use \App\Models\Edition;

    $edition = Edition::current();
@endphp

<nav x-data="{ open: false }" class="w-full bg-transparent shadow-none border-none">
    <div class="max-w-full mx-auto">
        <div class="flex items-center justify-between h-16 px-8" style="background:rgba(7,14,28,0.95);">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0">
                <span class="text-2xl font-extrabold" style="color: #FFFF3C;">WAITT25</span>
            </div>
            <!-- Centered Nav Links -->
            <div class="flex-1 flex justify-center gap-6">
                <a href="{{ route('welcome') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-[#FFFF3C] font-bold underline underline-offset-8' : '' }}">Home</a>
                <a href="{{ route('speakers.index') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('speakers.index') ? 'text-[#FFFF3C] font-bold underline underline-offset-8' : '' }}">Speakers</a>
                <a href="{{ route('programme') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('programme') ? 'text-[#FFFF3C] font-bold underline underline-offset-8' : '' }}">Presentations</a>
                <a href="{{ route('companies.index') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('companies.index') ? 'text-[#FFFF3C] font-bold underline underline-offset-8' : '' }}">Companies</a>
                <a href="{{ route('faq') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('faq') ? 'text-[#FFFF3C] font-bold underline underline-offset-8' : '' }}">FAQ</a>
                <a href="{{ route('contact') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-[#FFFF3C] font-bold underline underline-offset-8' : '' }}">Contact</a>
            </div>
            <!-- Login on the right -->
            <div class="flex items-center ml-8">
                <a href="{{ route('login') }}" class="text-base font-normal text-white hover:text-gray-200 transition-colors duration-200 {{ request()->routeIs('login') ? 'text-[#FFFF3C] font-bold' : '' }}">Login</a>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Hamburger button here (restore your previous implementation) -->
            </div>
        </div>
    </div>
</nav>

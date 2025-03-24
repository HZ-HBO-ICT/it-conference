<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 flex items-center justify-center bg-blue-100 rounded-full">
                        <span class="text-blue-600 font-bold text-lg">IT</span>
                    </div>
                    <span class="font-bold text-xl text-gray-800">IT Conference</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-8 items-center">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-sm font-medium hover:text-blue-600">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    {{ __('Speakers') }}
                </x-nav-link>
                <x-nav-link href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    {{ __('Companies') }}
                </x-nav-link>
                <x-nav-link href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    {{ __('FAQ') }}
                </x-nav-link>
                <x-nav-link href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    {{ __('Contact') }}
                </x-nav-link>
            </div>

            <!-- Right side (Login/Dropdowns) -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- Profile photo or name -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Login</a>
                @endauth

                <!-- Theme toggle -->
                <button class="text-blue-600 hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8-9h1M3 12H2m15.36 6.36l.7.7M6.34 6.34l-.7-.7m0 13.42l.7-.7m13.42-13.42l-.7.7" />
                    </svg>
                </button>
            </div>

            <!-- Hamburger Menu -->
            <div class="md:hidden">
                <button @click="open = ! open" class="text-blue-600 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Nav Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white shadow-sm border-t">
        <div class="py-4 space-y-1 px-4">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                {{ __('Speakers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                {{ __('Companies') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                {{ __('FAQ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>

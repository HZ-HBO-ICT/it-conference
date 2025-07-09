@php
    use \App\Models\Edition;

    $edition = Edition::current();
@endphp

<nav x-data="{ open: false }"
     class="relative z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-wrap items-center justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="/">
                    <img src="{{ asset('/img/waitt25/logo.webp') }}" alt="WAITT Logo" class="h-6 w-auto max-w-full" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-waitt.nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')"
                                      wire:navigate.hover>
                        {{ __('Home') }}
                    </x-waitt.nav-link>
                </div>

                @if($edition)
                    <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                        <x-waitt.nav-link href="{{ route('speakers.index') }}" :active="request()->routeIs('speakers.index')"
                                          wire:navigate.hover>
                            {{ __('Speakers') }}
                        </x-waitt.nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                        <x-waitt.nav-link href="{{ route('companies.index') }}" :active="request()->routeIs('companies.index')"
                                          wire:navigate.hover>
                            {{ __('Companies') }}
                        </x-waitt.nav-link>
                    </div>
                @endif

                @if(optional($edition)->is_final_programme_released)
                    <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                        <x-waitt.nav-link href="{{ route('programme') }}" :active="request()->routeIs('programme')"
                                          wire:navigate.hover>
                            {{ __('Programme') }}
                        </x-waitt.nav-link>
                    </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-waitt.nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')" wire:navigate.hover>
                        {{ __('FAQ') }}
                    </x-waitt.nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-waitt.nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')"
                                      wire:navigate.hover>
                        {{ __('Contact') }}
                    </x-waitt.nav-link>
                </div>
            </div>

            <div class="grow flex justify-end">
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-waitt.nav-link href="{{ route('login') }}" :active="request()->routeIs('login')"
                                      wire:navigate.hover>
                        {{ __('Login') }}
                    </x-waitt.nav-link>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="mr-0 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 focus:outline-hidden transition duration-150 ease-in-out">
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
    <div :class="{'block': open, 'hidden': ! open}" class="bg-waitt-dark hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-waitt.responsive-nav-link wire:navigate.hover href="{{ route('welcome') }}"
                                         :active="request()->routeIs('welcome')">
                {{ __('Home') }}
            </x-waitt.responsive-nav-link>
            @if($edition)
                <x-waitt.responsive-nav-link wire:navigate.hover href="{{ route('speakers.index') }}"
                                             :active="request()->routeIs('speakers.index')">
                    {{ __('Speakers') }}
                </x-waitt.responsive-nav-link>
                <x-waitt.responsive-nav-link wire:navigate.hover href="{{ route('companies.index') }}"
                                             :active="request()->routeIs('companies.index')">
                    {{ __('Companies') }}
                </x-waitt.responsive-nav-link>
            @endif
            @if(optional($edition)->is_final_programme_released)
                <x-waitt.responsive-nav-link href="{{ route('programme') }}" :active="request()->routeIs('programme')">
                    {{ __('Programme') }}
                </x-waitt.responsive-nav-link>
            @endif
            <x-waitt.responsive-nav-link wire:navigate.hover href="{{ route('faq') }}"
                                         :active="request()->routeIs('faq')">
                {{ __('FAQ') }}
            </x-waitt.responsive-nav-link>
            <x-waitt.responsive-nav-link wire:navigate.hover href="{{ route('contact') }}"
                                         :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-waitt.responsive-nav-link>
            <x-waitt.responsive-nav-link wire:navigate.hover href="{{ route('login') }}"
                                         :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-waitt.responsive-nav-link>
            <div class="border-t border-gray-200 dark:border-gray-600"></div>
        </div>
    </div>
    </div>
</nav>

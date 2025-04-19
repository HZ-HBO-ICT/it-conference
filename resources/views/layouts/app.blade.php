<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&ital@0;1&display=swap"
        rel="stylesheet">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <script>
        if (localStorage.getItem('dark_mode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="font-sans antialiased bg-[#0B1221]">
    <div class="min-h-screen">
        <x-banner/>

        <!-- Navigation -->
        <nav class="bg-[#0B1221]/80 backdrop-blur-sm border-b border-[#31F7F1]/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-[#E2FF32] hover:text-[#f0ff32] transition-colors">WAITT25</a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('welcome') }}" class="text-white hover:text-[#31F7F1] transition-colors relative group {{ request()->routeIs('welcome') ? 'text-[#31F7F1]' : '' }}">
                            Home
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#31F7F1] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                        <a href="{{ route('speakers.index') }}" class="text-white hover:text-[#31F7F1] transition-colors relative group {{ request()->routeIs('speakers.index') ? 'text-[#31F7F1]' : '' }}">
                            Speakers
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#31F7F1] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                        <a href="{{ route('companies.index') }}" class="text-white hover:text-[#31F7F1] transition-colors relative group {{ request()->routeIs('companies.index') ? 'text-[#31F7F1]' : '' }}">
                            Companies
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#31F7F1] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                        <a href="{{ route('faq') }}" class="text-white hover:text-[#31F7F1] transition-colors relative group {{ request()->routeIs('faq') ? 'text-[#31F7F1]' : '' }}">
                            FAQ
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#31F7F1] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                        <a href="{{ route('contact') }}" class="text-white hover:text-[#31F7F1] transition-colors relative group {{ request()->routeIs('contact') ? 'text-[#31F7F1]' : '' }}">
                            Contact
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#31F7F1] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                    </div>

                    <!-- Right side -->
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('login') }}" class="text-white hover:text-[#31F7F1] transition-colors relative group">
                            Login
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-[#31F7F1] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                        </a>
                        <button class="dark-mode-toggle hover:rotate-90 transition-transform duration-300" x-data="{
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
                            <svg class="w-6 h-6 text-[#31F7F1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        @if (in_array(Route::currentRouteName(), config('routesWithFooter.routes')) && !Str::contains(Request::url(), ['errors']))
        <footer class="bg-[#0B1221]/80 backdrop-blur-sm border-t border-[#31F7F1]/10">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Conference Info -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('welcome') }}" class="text-2xl font-bold text-[#E2FF32] hover:text-[#f0ff32] transition-colors">WAITT25</a>
                        </div>
                        <p class="text-gray-400 text-sm">
                            Join us for an immersive experience where technology meets innovation, powering the future of IT together.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-[#31F7F1] hover:text-[#E2FF32] transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-[#31F7F1] hover:text-[#E2FF32] transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-[#31F7F1] hover:text-[#E2FF32] transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('speakers.index') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">Speakers</a>
                            </li>
                            <li>
                                <a href="{{ route('companies.index') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">Companies</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">FAQ</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Resources -->
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">Resources</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('faq') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">FAQ</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">Contact</a>
                            </li>
                            <li>
                                <a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="{{ route('terms-and-conditions') }}" class="text-gray-400 hover:text-[#31F7F1] transition-colors">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">Stay Updated</h3>
                        <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for the latest updates.</p>
                        <form class="space-y-2">
                            <div class="relative">
                                <input type="email" placeholder="Your email" class="w-full px-4 py-2 bg-white/5 border border-[#31F7F1]/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-[#31F7F1] transition-colors">
                            </div>
                            <button type="submit" class="w-full px-4 py-2 bg-[#31F7F1] text-[#0B1221] rounded-lg font-semibold hover:bg-[#E2FF32] transition-colors">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="mt-12 pt-8 border-t border-[#31F7F1]/10">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <p class="text-gray-400 text-sm mb-4 md:mb-0">
                            © 2025 WAITT Conference. All rights reserved.
                        </p>
                        <div class="flex space-x-6">
                            <a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-[#31F7F1] text-sm transition-colors">Privacy Policy</a>
                            <a href="{{ route('terms-and-conditions') }}" class="text-gray-400 hover:text-[#31F7F1] text-sm transition-colors">Terms of Service</a>
                            <a href="{{ route('cookie-statement') }}" class="text-gray-400 hover:text-[#31F7F1] text-sm transition-colors">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        @endif
    </div>

    <x-toaster-hub />

    @stack('modals')
    @stack('scripts')
    @livewireScripts
    @livewire('wire-elements-modal')
</body>
</html>

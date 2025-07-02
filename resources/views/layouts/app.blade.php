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
<body class="font-sans antialiased bg-waitt-dark">

    <div>
        <x-banner/>
        <div class="text-black dark:text-white">
            @if (!Str::contains(Request::url(), ['errors']))
                @guest()
                    @livewire('guest-navigation-menu')
                @endguest
                @auth()
                    @livewire('auth-navigation-menu')
                @endauth
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    @if (in_array(Route::currentRouteName(), config('routesWithFooter.routes')) && !Str::contains(Request::url(), ['errors']))
        <footer class="bg-waitt-dark relative z-40">
            <div class="mx-auto w-full max-w-(--breakpoint-xl)">
                <div class="grid grid-cols-2 mt-8 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-100 uppercase dark:text-white">Pages</h2>
                        <ul class="text-gray-300 font-medium">
                            <li class="mb-4">
                                <a href="{{ route('welcome') }}" class=" hover:underline">Home</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('speakers.index') }}" class="hover:underline">Speakers</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('companies.index') }}" class="hover:underline">Companies</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('faq') }}" class="hover:underline">FAQ</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-100 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-300 font-medium">
                            <li class="mb-4">
                                <a href="{{ route('privacy-policy') }}" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('cookie-statement') }}" class="hover:underline">Cookie Statement</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('terms-and-conditions') }}" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                    <div></div>
                    <div class="text-white">
                        <h1 class="text-2xl font-bold py-2">Let's Stay Connected</h1>
                        <p class="pb-2">Follow us on social media to stay updated with the latest news and announcements.</p>
                        <hr/>
                        <h1 class="text-2xl font-bold py-2">Follow us</h1>
                        <div class="flex mt-4 sm:justify-left md:mt-0 space-x-5 rtl:space-x-reverse">
                            <a href="https://www.linkedin.com/company/we-are-in-it-together-conference/" target="_blank" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                <svg class="w-12 h-12 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z" />
                                </svg>
                                <span class="sr-only">Linkedin</span>
                            </a>
                            <a href="https://www.youtube.com/@weareinittogether" target="_blank" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-12 h-12 fill-white" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                </svg>
                                <span class="sr-only">Youtube</span>
                            </a>
                            <a href="https://github.com/HZ-HBO-ICT/it-conference" target="_blank" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                <svg class="w-12 h-12 fill-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span class="sr-only">GitHub account</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 md:flex md:items-center md:justify-between">
                    <span class="text-sm text-gray-300 sm:text-center"> © 2025 IT Together Conference | Made by IT-Conference Website Team. All Rights Reserved.
                    </span>
                </div>
            </div>
        </footer>
    @endif
    <x-toaster-hub />

    @stack('modals')
    @stack('scripts')
    @livewireScripts
    @livewire('wire-elements-modal')
</body>
</html>

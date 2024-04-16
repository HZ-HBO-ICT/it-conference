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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@0;1&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        });

        function changeTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark')
                localStorage.theme = 'light'
            } else {
                document.documentElement.classList.add('dark')
                localStorage.theme = 'dark'
            }
        }
    </script>
</head>
<body class="font-sans antialiased">
    <x-banner/>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @guest()
            @livewire('guest-navigation-menu')
        @endguest
        @auth()
            @livewire('auth-navigation-menu')
        @endauth

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <footer class="footer mt-auto py-3 bg-white dark:bg-gray-800">
        <p class="text-center text-muted dark:text-gray-200">
            © 2024 IT Conference | Made by IT Conference Website Team
        </p>
    </footer>

    @stack('modals')
    @stack('scripts')
    @livewireScripts
    @livewire('wire-elements-modal')
</body>
</html>

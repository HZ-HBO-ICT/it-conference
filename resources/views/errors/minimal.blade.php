<x-app-layout>
    <div
        class="before:absolute before:inset-0 before:bg-gradient-to-br before:from-gradient-yellow before:via-gradient-pink before:via-gradient-purple before:to-gradient-blue before:opacity-70"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <div>
            <h1 class="text-white text-9xl leading-snug font-bold text-center md:whitespace-nowrap"
                style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                @yield('code')
            </h1>
            <p class="text-white text-2xl leading-snug text-center md:whitespace-nowrap"
                style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);">
                @yield('message')
            </p>
        </div>
    </div>
</x-app-layout>

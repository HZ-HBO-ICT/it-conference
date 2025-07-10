<x-app-layout>
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
    </div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 overflow-y-hidden">
        <h1 class="text-white text-8xl font-bold leading-snug text-center md:whitespace-nowrap">
            @yield('code')
        </h1>
        <p class="text-white text-xl leading-snug text-center text-balance md:whitespace-nowrap">
            @yield('message')
        </p>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="flex flex-col overflow-hidden">
        <div class="relative flex flex-col items-center px-4 py-16">
            <!--Titles-->
            <div
                class="flex flex-col md:flex-row justify-start items-start w-full max-w-7xl space-y-8 md:space-y-0 md:space-x-8 mt-6">
                <div
                    class="text-white w-full lg:ml-16 md:w-3/5 font-extrabold text-5xl lg:text-7xl md:text-7xl sm:text-5xl uppercase">
                    <h1 class="leading-extra-tight" style="text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);">
                        {{ $message }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

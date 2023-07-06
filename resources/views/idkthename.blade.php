<x-app-layout>
    {{-- icons link !!!MOVE TO HEAD!!--}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"
    />

    <div class="container flex h-full">
        <div class="sidebar pb-56 w-1/5 top-0 h-full bottom-0 lg:left-0 p-2 overflow-y-auto text-center bg-gray-900">
            <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer">
                <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
            </span>
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
{{--                    <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>--}}
                    <i class="bi bi-shield-fill-check px-2 py-1 rounded-md bg-gray-800"></i>
                    <h1 class="font-bold text-gray-200 text-[15px] ml-3 font-extrabold">Content Moderation</h1>
                </div>
                <div class="my-2 bg-gray-600 h-[1px]"></div>
            </div>
            {{-- dashboard navigation link --}}
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 bg-blue-600 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-bar-chart-line-fill"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold">Dashboard</span>
            </div>

            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <i class="bi bi-bookmark-fill"></i>
                <span class="text-[15px] ml-4 text-gray-200 font-bold">text</span>
            </div>
            <div class="my-4 bg-gray-600 h-[1px]"></div>
            {{-- it conference link --}}
            <a href="/">
                <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                    <i class="bi bi-house-door-fill"></i>
                    <div class="flex justify-between w-full items-center">
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">IT-Conference Page</span>
                    </div>
                </div>
            </a>
            {{-- logout --}}
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
                    </div>
                </a>
            </form>
            {{-- end logout --}}
        </div>

{{--        main content--}}
        <div class="container bg-gradient-to-r from-gray-950 to-gray-800 w-4/5 ml-1/5 h-[34rem]">
            <div class="container flex pt-4">
{{--                title--}}
                <h2 class="text-4xl font-extrabold text-white ml-4">Requests</h2>

                <div class="relative ml-auto mr-6">
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-neutral-950 bg-gray-200 hover:bg-gray-900 hover:text-white focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        <span id="dropdownButtonText">All time</span>
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg right-0 shadow w-34 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" class="block dditem px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All time</a>
                            </li>
                            <li>
                                <a href="#" class="block dditem px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">This Month</a>
                            </li>
                            <li>
                                <a href="#" class="block dditem px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">This Week</a>
                            </li>
                            <li>
                                <a href="#" class="block dditem px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="mt-7 container flex justify-center columns-3 items-center">
{{--                company requests--}}
                <div class="card w-72 h-40 ml-12 mr-12 rounded-md bg-indigo-950">
{{--                    label--}}
                    <div class="bg-indigo-700 text-white font-bold rounded-t px-4 py-2">
                        <i class="mr-2 bi bi-people-fill display-5"></i>
                        Company Requests:
                    </div>
                    <div class="mt-4 mb-2 w-full h-auto flex flex-col justify-center items-center">
                        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">35</h1>
                    </div>
                    <a href="#" class="text-white ml-4 underline underline-offset-8 hover:text-gray-300"> View All </a>
                </div>

                        {{--speaker requests--}}
                <div class="card w-72 h-40 ml-12 mr-12 rounded-md bg-indigo-950">
                    {{--                    label--}}
                    <div class="bg-indigo-700 text-white font-bold rounded-t px-4 py-2">
                        <i class="mr-2 bi bi-megaphone-fill"></i>
                        Speaker Requests:
                    </div>
                    <div class="mt-4 mb-2 w-full h-auto flex flex-col justify-center items-center">
                        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">5</h1>
                    </div>
                    <a href="#" class="text-white ml-4 underline underline-offset-8 hover:text-gray-300"> View All </a>
                </div>


                {{--booth requests--}}
                <div class="card w-72 h-40 ml-12 mr-12 rounded-md bg-indigo-950">
                    {{--                    label--}}
                    <div class="bg-indigo-700 text-white font-bold rounded-t px-4 py-2">
                        <i class="mr-2 bi bi-shop-window"></i>
                        Booth Requests:
                    </div>
                    <div class="mt-4 mb-2 w-full h-auto flex flex-col justify-center items-center">
                        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">12</h1>
                    </div>
                    <a href="#" class="text-white ml-4 underline underline-offset-8 hover:text-gray-300"> View All </a>
                </div>
            </div>

{{--            2nd row (workshop presentation)--}}
            <div class="mt-10 container flex justify-center columns-2 items-center">
                <div class="card w-96 h-40 bg-sky-950 ml-12 mr-12 rounded-lg">
                    <div class="bg-sky-700 text-white font-bold rounded-t px-4 py-2">
                        <i class="mr-2 bi bi-display"></i>
                        Presentation Requests:
                    </div>
                    <div class="mt-4 mb-2 w-full h-auto flex flex-col justify-center items-center">
                        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">11</h1>
                    </div>
                    <a href="#" class="text-white ml-4 underline underline-offset-8 hover:text-gray-300"> View All </a>
                </div>

                <div class="card w-96 h-40 bg-sky-950 ml-12 mr-12 rounded-lg">
                    <div class="bg-sky-700 text-white font-bold rounded-t px-4 py-2">
                        <i class="mr-2 bi bi-tools"></i>
                        Workshop Requests:
                    </div>
                    <div class="mt-4 mb-2 w-full h-auto flex flex-col justify-center items-center">
                        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">9</h1>
                    </div>
                    <a href="#" class="text-white ml-4 underline underline-offset-8 hover:text-gray-300"> View All </a>
                </div>

            </div>
        </div>
    </div>

    <style>
        #dropdown {
            position: absolute;
            top: 100%;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const button = document.getElementById("dropdownDefaultButton");
            const buttonText = document.getElementById("dropdownButtonText");
            const dropdown = document.getElementById("dropdown");
            const dropdownItems = document.querySelectorAll(".dditem");

            for (let i = 0; i < dropdownItems.length; i++) {
                dropdownItems[i].addEventListener("click", function (event) {
                    event.preventDefault(); // Prevent page navigation

                    const selectedValue = this.textContent.trim();
                    buttonText.textContent = selectedValue;
                    dropdown.classList.toggle("hidden");

                    event.stopPropagation(); // Prevent event bubbling to the button element
                });
            }

            button.addEventListener("click", function () {
                dropdown.classList.toggle("hidden");
            });
        });
    </script>
</x-app-layout>

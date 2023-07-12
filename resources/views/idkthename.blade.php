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
    <!-- Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
<x-banner/>
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">


    <!-- Page Content -->
    <main class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <div class="container flex min-h-screen min-w-0">
        <div class="sidebar w-1/5 top-0 h-auto bottom-0 lg:left-0 p-2 overflow-y-auto text-center bg-white">
            <span class="absolute text-white text-4xl top-5 left-4 cursor-pointer">
            </span>
            <div class="text-gray-950 text-xl">
                <a href="{{ route('profile.show') }}">
                <div class="p-2.5 mt-1 flex items-center">
                    <img class="h-8 w-8 rounded-full object-cover"
                         src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                    <h1 class="font-bold text-gray-950 text-[15px] ml-3 font-extrabold hover:underline underline-offset-8 transition-all">{{ Auth::user()->name }}</h1>
                </div>
                <div class="my-2 bg-gray-600 h-[1px]"></div>
                </a>
            </div>
            {{-- dashboard navigation link --}}
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-cyan-600 hover:text-white text-gray-950">
                <i class="bi bi-bar-chart-line-fill"></i>
                <span class="text-[15px] ml-4 font-bold">Dashboard</span>
            </div>

{{--            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-cyan-600 hover:text-white text-gray-950 transition-all">--}}
{{--                <i class="bi bi-bookmark-fill"></i>--}}
{{--                <span class="text-[15px] ml-4 font-bold">text</span>--}}
{{--            </div>--}}
            <div class="my-4 bg-gray-600 h-[1px]"></div>
            {{-- it conference link --}}
            <a href="/">
                <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-cyan-600 hover:text-white text-gray-950">
                    <i class="bi bi-house-door-fill"></i>
                    <div class="flex justify-between w-full items-center">
                        <span class="text-[15px] ml-4 font-bold">IT-Conference Page</span>
                    </div>
                </div>
            </a>
            {{-- logout --}}
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-cyan-600 hover:text-white text-gray-950">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="text-[15px] ml-4 font-bold">Logout</span>
                    </div>
                </a>
            </form>
            {{-- end logout --}}
        </div>
{{--        main content--}}
        <div class="container bg-gradient-to-r from-cyan-500 to-blue-500 w-4/5 ml-1/5 h-auto">
            <div class="container flex pt-4">
{{--                title--}}
                <h2 class="text-4xl font-extrabold text-white ml-4">Requests (72)</h2>

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
                <div class="card w-72 h-40 ml-12 mr-12 rounded-md bg-indigo-950 drop-shadow-lg">
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
                <div class="card w-72 h-40 ml-12 mr-12 rounded-md bg-indigo-950 drop-shadow-lg">
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
                <div class="card w-72 h-40 ml-12 mr-12 rounded-md bg-indigo-950 drop-shadow-lg">
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
            <div class="mt-10 container flex justify-center columns-1 items-center">
                <div class="card w-[35rem] h-40 bg-sky-950 ml-12 mr-12 rounded-lg drop-shadow-lg">
                    <div class="bg-sky-700 text-white font-bold rounded-t px-4 py-2">
                        <i class="mr-2 bi bi-tools"></i>
                        Presentation / Workshop Requests:
                    </div>
                    <div class="mt-4 mb-2 w-full h-auto flex flex-col justify-center items-center">
                        <h1 class="text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">20</h1>
                    </div>
                    <a href="#" class="text-white ml-4 underline underline-offset-8 hover:text-gray-300"> View All </a>
                </div>
            </div>
{{--            Overview section--}}
                <h2 class="text-4xl font-extrabold text-white mt-6 ml-4">Overview</h2>
{{--                    1st row--}}
                <div class="container flex justify-center columns-4 mt-10">
                    <div class="card ml-12 mr-12 bg-gray-200 w-52 h-32 rounded-md">
                        <div class="bg-gray-600 rounded-t px-2 py-1">
                            <h2 class="title ml-1 font-extrabold text-2xl text-white">Companies:</h2>
                        </div>
                        <div class="mt-2 ml-4 mb-2 w-full h-auto">
                                <h1 class="text-4xl leading-none tracking-tight text-cyan-900 md:text-5xl lg:text-6xl">56</h1>
                        </div>
                    </div>
                    <div class="card ml-12 mr-12 bg-gray-200 w-52 h-32 rounded-md">
                        <div class="bg-gray-600 rounded-t px-2 py-1">
                            <h2 class="title ml-1 font-extrabold text-2xl text-white">Participants:</h2>
                        </div>
                        <div class="mt-2 ml-4 mb-2 w-full h-auto">
                            <h1 class="text-4xl leading-none tracking-tight text-cyan-900 md:text-5xl lg:text-6xl">153</h1>
                        </div>
                    </div>
                    <div class="card ml-12 mr-12 bg-gray-200 w-52 h-32 rounded-md">
                        <div class="bg-gray-600 rounded-t px-2 py-1">
                            <h2 class="title ml-1 font-extrabold text-2xl text-white">Speakers: </h2>
                        </div>
                        <div class="mt-2 ml-4 mb-2 w-full h-auto">
                            <h1 class="text-4xl leading-none tracking-tight text-cyan-900 md:text-5xl lg:text-6xl">43</h1>
                        </div>
                    </div>
                    <div class="card ml-12 mr-12 bg-gray-200 w-52 h-32 rounded-md">
                        <div class="bg-gray-600 rounded-t px-2 py-1">
                            <h2 class="title ml-1 font-extrabold text-2xl text-white">Booths:</h2>
                        </div>
                        <div class="mt-2 ml-4 mb-2 w-full h-auto">
                            <h1 class="text-4xl leading-none tracking-tight text-cyan-900 md:text-5xl lg:text-6xl">10</h1>
                        </div>
                    </div>
                </div>
            {{--2nd row--}}
            <div class="container flex justify-center columns-2 mt-10 mb-6">
                <div class="card ml-12 mr-12 bg-gray-200 w-52 h-32 rounded-md">
                    <div class="bg-gray-600 rounded-t px-2 py-1">
                        <h2 class="title ml-1 font-extrabold text-2xl text-white">Presentations:</h2>
                    </div>
                    <div class="mt-2 ml-4 mb-2 w-full h-auto">
                        <h1 class="text-4xl leading-none tracking-tight text-cyan-900 md:text-5xl lg:text-6xl">32</h1>
                    </div>
                </div>
                <div class="card ml-12 mr-12 bg-gray-200 w-52 h-32 rounded-md">
                    <div class="bg-gray-600 rounded-t px-2 py-1">
                        <h2 class="title ml-1 font-extrabold text-2xl text-white">Workshops:</h2>
                    </div>
                    <div class="mt-2 ml-4 mb-2 w-full h-auto">
                        <h1 class="text-4xl leading-none tracking-tight text-cyan-900 md:text-5xl lg:text-6xl">10</h1>
                    </div>
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
    </main>
</div>
<footer class="footer mt-auto py-3 bg-white dark:bg-gray-800">
    <p class="text-center text-muted dark:text-gray-200">
        © 2023 IT Conference | Made by IT Conference Website Team
    </p>
</footer>

@stack('modals')

@livewireScripts
</body>
</html>

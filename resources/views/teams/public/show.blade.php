<x-app-layout>
    <div class="container h-screen mx-auto px-6 py-12">
        <h2 class="text-center text-gray-50 dark:text-gray-900 text-4xl font-extrabold bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 mb-12">
            Our Companies / <span class="text-gray-900 dark:text-gray-50">{{$company->name}}</span>
        </h2>
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden transform transition-all">
            <div class="absolute top-0 left-0 w-full h-2 {{$borderColor}}"></div>
            <div class="grid grid-cols-1 sm:grid-cols-3 p-10">
                <div class="h-full flex items-center justify-center">
                    <div class="w-grid grid-cols-1">
                        <div class="relative w-64 h-64 col-span-1">
                            @if($company->logo_path)
                                <div class="absolute inset-0 rounded-full opacity-75 blur-lg"></div>
                                <img class="relative w-64 h-64 rounded-full object-cover"
                                     src="{{url('storage/'. $company->logo_path) }}"
                                     alt="Profile picture of {{$company->name}}">
                            @else
                                <div class="absolute inset-0 rounded-full opacity-75 blur-lg"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1"
                                     stroke="gray" aria-hidden="true" class="w-56 h-56 {{$iconColor}}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                                </svg>
                            @endif
                        </div>
                        <h3 class="col-span-1 tracking-tight leading-7 font-semibold text-base mt-6 text-center dark:text-white">
                            Meet us at our booth!</h3>
                    </div>
                </div>
                <div class="col-span-2">
                    <h2 class="text-3xl {{$textColor}} font-bold mb-4">{{$company->name}}</h2>

                    <div>
                        <h2 class="text-2xl font-bold">About Us</h2>
                        <p class="leading-relaxed">{{ $company->description }}</p>
                    </div>

                    <div class="mt-5">
                        <h3 class="text-2xl font-semibold">Location</h3>
                        <p class="leading-relaxed">
                            {{ $company->street }} {{ $company->house_number }}<br>
                            {{ $company->postcode }} {{ $company->city }}
                        </p>
                    </div>

                    <div class="mt-5">
                        <h3 class="text-2xl font-semibold">Visit Our Website</h3>
                        <a href="{{ $company->website }}" class="{{$linkColor}} hover:underline">
                            {{ $company->website }}
                        </a>
                    </div>

                    <div class="mt-5">
                        @if(!$company->presentations->isEmpty())
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">Presentations</h3>
                            <div class="space-y-4">
                                @foreach($company->presentations as $presentation)
                                    <a href="{{route('programme.presentation.show', $presentation)}}"
                                       class="block bg-white dark:bg-gray-700 p-4 border  rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-300">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="#8b5cf6"
                                                     aria-hidden="true" class="w-6 h-6 {{$iconColor}}">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <h4 class="text-lg font-semibold">{{ $presentation->name }}</h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Hosted
                                                                                                    by: {{ $presentation->speakers_name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-2 {{$borderColor}}"></div>
        </div>

    </div>
</x-app-layout>

@php
    $tiers = [
        1 => ['label' => 'Gold', 'color' => 'bg-yellow-400 text-yellow-900'],
        2 => ['label' => 'Silver', 'color' => 'bg-gray-300 text-gray-900'],
        3 => ['label' => 'Bronze', 'color' => 'bg-amber-900 text-amber-100'],
    ];
@endphp

<x-app-layout>
    <div class="min-h-screen py-16 px-4 sm:px-8 relative overflow-hidden">
        <!-- Colorful Blobs Background -->
        <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <!-- End Blobs -->

        <div class="relative z-10 max-w-7xl mx-auto flex flex-col lg:flex-row gap-12 min-h-[80vh] justify-center">
            <aside class="col-span-1 z-10 rounded-3xl pr-5 space-y-8">
                <div class="flex justify-center">
                    @if($company->logo_path)
                        <img src="{{ asset($company->logo_path) }}"
                             alt="{{ $company->name }}"
                             class="rounded-lg w-full h-56 object-contain shadow-xl border-4 border-opacity-30" />
                    @else
                        <div class="h-56 w-full bg-waitt-dark rounded flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-300 size-24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="text-left text-white text-lg grid grid-cols-1 gap-2">
                    @if($company->sponsorship)
                        <x-waitt.tag :title="$company->sponsorship->name"/>
                    @endif
                    <h2 class="text-3xl font-bold">{{ $company->name }}</h2>
                    <div class="inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ $company->city }}
                    </div>
                    <div class="inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>
                        <a href="{{$company->website}}" class="underline hover:text-waitt-pink transition-colors">
                            {{ $company->website }}
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Right Section -->
            <div class="flex-1 flex flex-col gap-8 text-white">
                <div>
                    <h2 class="text-2xl font-extrabold mb-2">About</h2>
                    <p class="text-lg text-gray-200">{{ $company->description }}</p>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold mb-2">Internship opportunities</h2>
                    @if($company->internshipAttributes()->tracks()->pluck('value')->count() > 0)
                        <ul class="list-disc ml-6 text-lg text-gray-200">
                            @foreach($company->internshipAttributes()->tracks()->pluck('value') as $track)
                                <li>{{ $track }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-lg text-gray-400">No internship opportunities specified.</p>
                    @endif
                </div>
                @if($company->booth)
                    <div>
                        <h2 class="text-2xl font-extrabold mb-2">Meet Us at the Conference</h2>
                        <p class="text-lg text-gray-200">Visit our booth at the conference to learn more about {{ $company->name }} and the opportunities we offer. Our team will be available to answer your questions and discuss potential career paths.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

@php use Carbon\Carbon; @endphp
<x-app-layout>
    <section class="min-h-screen py-20 px-6 lg:px-12 relative overflow-hidden">
        <!-- Decorative Blobs Background -->
        <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <!-- End Blobs -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 xl:grid-cols-3 gap-16 items-start">

            <aside class="col-span-1 z-10 rounded-3xl pr-5 space-y-8">
                <div class="flex justify-center">
                    <img src="{{ $speaker->user->profile_photo_url }}"
                         alt="{{ $speaker->user->name }}"
                         class="rounded-lg w-full object-contain shadow-xl border-4 border-opacity-30"/>
                </div>

                <div class="text-left text-white text-lg grid grid-cols-1 gap-2">
                    <h2 class="text-3xl font-bold">{{ $speaker->user->name }}</h2>
                    @if($speaker->user->company)
                        <div>
                            <p><strong>Company:</strong> {{ $speaker->user->company->name }}</p>
                            <a href="{{ route('companies.show', $speaker->user->company) }}"
                               class="inline-flex items-center gap-1 mt-1 rounded-md text-brand-yellow underline font-medium hover:text-waitt-yellow transition-all duration-200">
                                Learn more about the company here
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    @else
                        <p><strong>Institution:</strong> {{ $speaker->user->insitutiuon }}</p>
                    @endif
                </div>
            </aside>

            <article class="col-span-2 space-y-12">
                @if($speaker->presentation->name)
                    <div>
                        <h3 class="text-2xl text-white font-semibold mb-3">Presentation</h3>
                        <div class="border-gray-400 border-2 text-white gap-4 grid grid-cols-1 rounded-lg p-5">
                            <x-waitt.tag :title="$speaker->presentation->difficulty->level"/>
                            <h1 class="text-2xl font-semibold italic">{{$speaker->presentation->name}}</h1>
                            <p> {{$speaker->presentation->description}} </p>
                            <div class="inline-flex gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                {{ $edition->is_final_programme_released ? Carbon::parse($speaker->presentation->start)->format('H:i') : 'TBC' }}
                            </div>
                            <div class="inline-flex gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                </svg>
                                {{ $edition->is_final_programme_released ? $speaker->presentation->room->name : 'TBC' }}
                            </div>
                        </div>
                    </div>
                @endif
            </article>
        </div>
    </section>
</x-app-layout>

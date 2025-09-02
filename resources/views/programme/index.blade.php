@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <div class="min-h-screen relative overflow-hidden mx-auto px-4 pt-14 pb-24">
        <!-- Decorative Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
            <div
                class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
            <div
                class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4">
            <h1 class="text-6xl font-extrabold text-left mb-4 uppercase tracking-wide mb-10 text-waitt-yellow max-sm:text-4xl max-sm:text-center">
                Programme
            </h1>
            <div class="hidden md:block">
                <div
                    class="flex w-full shadow-lg overflow-x-auto overflow-y-hidden scrollbar-thin scrollbar-thumb-waitt-cyan-500 scrollbar-track-rounded-full scrollbar-track-slate-950">
                    <table
                        class="h-max min-w-max bg-waitt-dark/70 backdrop-blur-sm rounded-4xl border border-slate-900 ">
                        <thead class="bg-waitt-dark border-b border-b-waitt-cyan-400/80">
                        <tr>
                            <th class="w-18 p-4 text-center text-white rounded-tl-lg border-gray-300 dark:border-gray-900">
                            </th>
                            @foreach ($rooms as $room)
                                <th class="w-64 p-4 text-center text-waitt-pink border-gray-300 dark:border-gray-900m">{{$room->name}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody id="grid-body">
                        @foreach($presentationsBySlot as $key => $presentations)
                            @php
                                $isEven = $loop->index % 2 == 0;
                            @endphp
                            <tr class=" text-gray-900">
                                <td class="text-gray-100 h-max align-top text-center border-gray-300 dark:border-gray-900 pt-1">{{$isEven ? Carbon::parse($key)->format('H:i') : ''}}</td>
                                @foreach ($rooms as $room)
                                    <td class="text-left h-max border-gray-300 dark:border-gray-900 relative overflow-visible">
                                        <div class="flex-none h-full w-full"
                                             style="height: {{ $height }}rem">
                                            <div class="flex flex-col">
                                                @foreach($presentations as $presentation)
                                                    <div>
                                                        @if($presentation->timeslot_id && $presentation->room_id == $room->id)
                                                            <x-programme.presentation :presentation="$presentation"/>
                                                        @elseif($presentation->room_id == $room->id)
                                                            <x-programme.default-presentation
                                                                :presentation="$presentation"/>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="block md:hidden space-y-6">
                @foreach($rooms as $room)
                    <div>
                        <h2 class="text-xl font-bold text-waitt-cyan-400 mb-3">
                            {{ $room->name  }}
                        </h2>
                        <div class="space-y-4">
                            @foreach($room->presentations->sortBy('start') as $presentation)
                                <div class="bg-waitt-dark/70 rounded-xl p-4 shadow border {{"border-{$presentation->presentationType->colour}-300"}}">
                                    <div class="flex flex-col text-center items-center justify-center w-full px-2">
                                        <span class="text-sm font-semibold {{"text-{$presentation->presentationType->colour}-300"}}">
                                            {{ $presentation->displayName(50, false)  }}
                                        </span>
                                        <span class="text-xs text-white">
                                            {{
                                                Carbon::parse($presentation->start)->format('H:i')
                                                . '-'
                                                . Carbon::parse($presentation->start)->addMinutes($presentation->duration)->format('H:i')
                                            }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

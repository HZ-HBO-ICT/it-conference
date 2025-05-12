@php
    $badgeColors = [
        1 => 'bg-yellow-400 text-gray-900', // Gold
        2 => 'bg-gray-400 text-gray-900',  // Silver
        3 => 'bg-orange-400 text-gray-900', // Bronze
    ];
@endphp

<x-app-layout>
    <div class="min-h-screen w-full bg-[#070E1C] px-6 py-12 flex flex-col items-center">
        <h1 class="text-7xl font-extrabold text-yellow-400 mb-8 tracking-tight text-center" style="text-shadow: 0 0 16px #fff600;">SPEAKERS</h1>
        <!-- Keynote Speaker Section (static for frontend) -->
        <div class="mb-16 max-w-5xl w-full flex flex-col items-center">
            <h2 class="text-2xl font-extrabold text-white mb-4 text-center">Keynote Speaker</h2>
            <div class="flex flex-col md:flex-row bg-[#0F172A] rounded-xl border border-gray-600 overflow-hidden shadow-lg w-full">
                <div class="flex-shrink-0 flex items-center justify-center min-h-[240px] min-w-[360px] bg-gray-300">
                    <!-- Placeholder image -->
                </div>
                <div class="flex-1 p-12 flex flex-col justify-center items-center md:items-start">
                    <h3 class="font-extrabold text-2xl text-white mb-2 text-center md:text-left">Dr. Alex Morgan</h3>
                    <div class="text-lg text-gray-300 mb-2 text-center md:text-left">Keynote Speaker at TechWave Solutions</div>
                    <div class="font-bold italic text-white text-lg mb-2 text-center md:text-left">The future of digital transformation</div>
                    <div class="text-gray-300 text-center md:text-left">Join us for an inspiring keynote that will set the tone for our conference and explore the cutting-edge developments in technology.</div>
                </div>
            </div>
        </div>
        @if(!$speakers->isEmpty())
            @if($edition->keynote_name)
                <div class="mb-16">
                    <h2 class="text-2xl font-extrabold text-white mb-4">Keynote Speaker</h2>
                    <div class="flex flex-col md:flex-row bg-[#0F172A] rounded-xl border border-gray-600 overflow-hidden shadow-lg">
                        <div class="flex-shrink-0 flex items-center justify-center min-h-[220px] min-w-[320px] bg-gray-300">
                            @if($edition->keynote_picture_source)
                                <img src="{{ $edition->keynote_picture_source }}" alt="Profile picture of {{$edition->keynote_name}}" class="object-cover w-full h-full max-h-64 max-w-xs" />
                            @endif
                        </div>
                        <div class="flex-1 p-8 flex flex-col justify-center">
                            <h3 class="font-extrabold text-2xl text-white mb-2">Dr. {{ $edition->keynote_name }}</h3>
                            <div class="text-lg text-gray-300 mb-2">Keynote Speaker at {{ $edition->keynote_company ?? 'TechWave Solutions' }}</div>
                            <div class="font-bold italic text-white text-lg mb-2">The future of digital transformation</div>
                            <div class="text-gray-300">{{ $edition->keynote_description }}</div>
                        </div>
                    </div>
                </div>
            @endif
            <h2 class="text-2xl font-extrabold text-white mb-6 mt-12 text-center">All Speakers</h2>
            <div class="w-full flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 justify-items-center">
                    @foreach($speakers as $speaker)
                        <div class="bg-[#10182A] rounded-2xl border border-gray-600 shadow-md overflow-hidden flex flex-col items-center max-w-md mx-auto transition-transform duration-200 hover:scale-105 hover:shadow-xl min-h-0">
                            <div class="flex flex-col items-center p-8 pb-6 w-full">
                                <div class="w-32 h-32 bg-gray-300 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                                    <!-- Speaker image here if available -->
                                </div>
                                <div class="w-full text-center">
                                    <div class="flex items-center justify-center gap-2 mb-1">
                                        <span class="font-extrabold text-xl text-white">{{$speaker->user->name}}</span>
                                        @if($speaker->user->company && $speaker->user->company->is_sponsorship_approved)
                                            @php $badge = $speaker->user->company->sponsorship_id; @endphp
                                            <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-bold {{$badgeColors[$badge] ?? ''}}">
                                                {{ $badge === 1 ? 'Gold' : ($badge === 2 ? 'Silver' : ($badge === 3 ? 'Bronze' : '')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-gray-300 mb-1 text-base">{{$speaker->user->company->name ?? ''}}</div>
                                    <div class="font-bold italic text-white text-base mb-1">{{$speaker->presentation->name ?? ''}}</div>
                                    <div class="text-gray-400 text-sm">{{strlen($speaker->presentation->description) > 100 ? substr($speaker->presentation->description, 0, 100) . '...' : $speaker->presentation->description}}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-[#0F172A] rounded-xl py-8 w-full flex justify-center">
                <p class="text-center text-2xl font-bold text-white">
                    There are no speakers available now.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>

@php
    $badgeColors = [
        1 => 'bg-yellow-400 text-gray-900', // Gold
        2 => 'bg-gray-400 text-gray-900',  // Silver
        3 => 'bg-orange-400 text-gray-900', // Bronze
    ];
@endphp

<x-app-layout>
    <div class="min-h-screen w-full bg-[#070E1C] px-6 py-12">
        <h1 class="text-7xl font-extrabold text-yellow-400 mb-8 tracking-tight" style="text-shadow: 0 0 16px #fff600;">SPEAKERS</h1>
        <!-- Keynote Speaker Section (static for frontend) -->
        <div class="mb-16">
            <h2 class="text-2xl font-extrabold text-white mb-4">Keynote Speaker</h2>
            <div class="flex flex-col md:flex-row bg-[#0F172A] rounded-xl border border-gray-600 overflow-hidden shadow-lg">
                <div class="flex-shrink-0 flex items-center justify-center min-h-[220px] min-w-[320px] bg-gray-300">
                    <!-- Placeholder image -->
                </div>
                <div class="flex-1 p-8 flex flex-col justify-center">
                    <h3 class="font-extrabold text-2xl text-white mb-2">Dr. Alex Morgan</h3>
                    <div class="text-lg text-gray-300 mb-2">Keynote Speaker at TechWave Solutions</div>
                    <div class="font-bold italic text-white text-lg mb-2">The future of digital transformation</div>
                    <div class="text-gray-300">Join us for an inspiring keynote that will set the tone for our conference and explore the cutting-edge developments in technology.</div>
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
            <h2 class="text-2xl font-extrabold text-white mb-6 mt-12">All Speakers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
                @foreach($speakers as $speaker)
                    <div class="bg-[#0F172A] rounded-xl border border-gray-700 shadow-lg overflow-hidden flex flex-col min-h-[320px]">
                        <div class="flex-1 flex flex-col justify-between">
                            <div class="flex flex-col items-center p-8 pb-4">
                                <div class="w-full flex justify-center mb-6">
                                    <div class="w-40 h-32 bg-gray-300 rounded-lg"></div>
                                </div>
                                <div class="w-full">
                                    <div class="flex items-center gap-2 mb-1">
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
                                    <div class="text-gray-400 text-sm">{{strlen($speaker->presentation->description) > 120 ? substr($speaker->presentation->description, 0, 120) . '...' : $speaker->presentation->description}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-[#0F172A] rounded-xl py-8">
                <p class="text-center text-2xl font-bold text-white">
                    There are no speakers available now.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>

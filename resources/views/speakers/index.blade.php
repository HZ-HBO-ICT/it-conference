@php
    $badgeColors = [
        1 => 'bg-yellow-400 text-gray-900', // Gold
        2 => 'bg-gray-400 text-gray-900',  // Silver
        3 => 'bg-orange-400 text-gray-900', // Bronze
    ];
@endphp

<x-app-layout>
    <div class="min-h-screen w-full bg-[#070E1C] px-6 py-12 flex flex-col items-center">
        <h1 class="text-7xl font-extrabold mb-8 tracking-tight text-center uppercase" style="color: #E2FF32; text-shadow: 0 0 30px rgba(226, 255, 50, 0.9), 0 0 50px rgba(226, 255, 50, 0.7), 0 0 70px rgba(226, 255, 50, 0.5);">Speakers</h1>
        
        @if(!$speakers->isEmpty())
            @if($edition->keynote_name)
                <div class="mb-16 max-w-5xl w-full">
                    <h2 class="text-3xl font-extrabold text-white mb-6 text-left">Keynote Speaker</h2>
                    <div class="flex flex-col md:flex-row bg-dark-card border border-gray-400 rounded-2xl overflow-hidden shadow-lg">
                        <div class="flex-shrink-0 flex items-center justify-center min-h-[260px] min-w-[340px] bg-gray-300" style="border-top-left-radius: 1rem; border-bottom-left-radius: 1rem;">
                            @if($edition->keynote_photo_path)
                                <img src="{{ $edition->keynote_photo_path }}" alt="Profile picture of {{$edition->keynote_name}}" class="object-cover w-full h-full max-h-64 max-w-xs" />
                            @else
                                <!-- Placeholder image -->
                            @endif
                        </div>
                        <div class="flex-1 p-10 flex flex-col justify-center border-l border-gray-400" style="border-top-right-radius: 1rem; border-bottom-right-radius: 1rem;">
                            <h3 class="font-extrabold text-3xl text-white mb-2">{{ $edition->keynote_name }}</h3>
                            @if($edition->keynote_company)
                                <div class="text-xl text-gray-200 mb-4">Keynote Speaker at {{ $edition->keynote_company }}</div>
                            @else
                                <div class="text-xl text-gray-200 mb-4">Keynote Speaker</div>
                            @endif
                            @if($edition->keynote_presentation_title)
                                <div class="font-bold italic text-white text-2xl mb-4">{{ $edition->keynote_presentation_title }}</div>
                            @endif
                            <div class="text-gray-200 text-lg">{{ $edition->keynote_description }}</div>
                        </div>
                    </div>
                </div>
            @endif
            <h2 class="text-2xl font-extrabold text-white mb-6 mt-12 text-center">All Speakers</h2>
            <div class="w-full flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 justify-items-center">
                    @foreach($speakers as $speaker)
                        <div class="bg-dark-card rounded-2xl border border-gray-600 shadow-md overflow-hidden flex flex-col items-center max-w-md mx-auto transition-transform duration-200 hover:scale-105 hover:shadow-xl min-h-0">
                            <div class="flex flex-col items-center p-8 pb-6 w-full">
                                <div class="w-32 h-32 bg-gray-300 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                                    <!-- Speaker image here if available -->
                                </div>
                                <div class="w-full text-center">
                                    <div class="flex items-center justify-center gap-2 mb-1">
                                        <span class="font-extrabold text-xl text-white">{{$speaker->user->name}}</span>
                                        @if($speaker->user->company && $speaker->user->company->is_sponsorship_approved && $speaker->user->company->sponsorship_id)
                                            @php $badge = $speaker->user->company->sponsorship_id; @endphp
                                            <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-bold {{$badgeColors[$badge] ?? ''}} border border-yellow-400">
                                                {{ $speaker->user->company->sponsorship->name }}
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
            <div class="bg-dark-card rounded-xl py-8 w-full flex justify-center">
                <p class="text-center text-2xl font-bold text-white">
                    There are no speakers available now.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>

<x-app-layout>
    <div class="min-h-screen relative overflow-hidden mx-auto px-4 pt-14 pb-24">
        <!-- Colorful Blobs Background -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 right-10 w-40 h-40 rounded-full bg-waitt-cyan opacity-30 blur-2xl"></div>
            <div class="absolute bottom-20 right-20 w-56 h-56 rounded-full bg-waitt-yellow opacity-20 blur-2xl"></div>
            <div class="absolute top-1/2 left-1/2 w-32 h-32 rounded-full bg-waitt-pink opacity-25 blur-2xl"></div>
            <div class="absolute top-40 right-32 w-32 h-32 rounded-full bg-waitt-cyan opacity-15 blur-2xl"></div>
            <div class="absolute bottom-32 left-1/4 w-28 h-28 rounded-full bg-waitt-yellow opacity-15 blur-2xl"></div>
            <div class="absolute top-3/4 left-3/4 w-36 h-36 rounded-full bg-waitt-pink opacity-10 blur-2xl"></div>
            <div class="absolute top-1/2 left-1/2 w-24 h-24 rounded-full bg-waitt-cyan opacity-20 blur-2xl"></div>
            <div class="absolute bottom-1/4 right-1/3 w-20 h-20 rounded-full bg-waitt-yellow opacity-10 blur-2xl"></div>
            <div class="absolute top-2/3 left-1/5 w-28 h-28 rounded-full bg-waitt-pink opacity-15 blur-2xl"></div>
            <div class="absolute bottom-1/5 right-1/4 w-32 h-32 rounded-full bg-waitt-cyan opacity-18 blur-2xl"></div>
            <div class="absolute top-1/3 right-1/6 w-16 h-16 rounded-full bg-waitt-yellow opacity-12 blur-2xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
        <h1 class="text-6xl font-extrabold text-left mb-12 uppercase tracking-wide text-waitt-yellow">
            Speakers
        </h1>

        @if($speakers->isNotEmpty())
            {{-- Keynote Speaker --}}
            @if($edition->keynote_name)
                <div class="w-full mb-12">
                    <h2 class="text-3xl font-extrabold text-white text-left my-6">Keynote Speaker</h2>
                    <div class="flex flex-col md:flex-row bg-dark-card border border-gray-400 rounded-2xl overflow-hidden shadow-lg">
                        <div class="flex-shrink-0 flex items-center justify-center min-h-[260px] min-w-[340px] bg-gray-300 rounded-l-2xl">
                            @if($edition->keynote_photo_path)
                                <img src="{{ $edition->keynote_photo_path }}" alt="Profile of {{ $edition->keynote_name }}" class="object-cover w-full h-full max-h-64 max-w-xs" />
                            @endif
                        </div>
                        <div class="flex-1 p-10 flex flex-col justify-center border-l border-gray-400 rounded-r-2xl">
                            <h3 class="font-extrabold text-3xl text-white mb-2">{{ $edition->keynote_name }}</h3>
                            <div class="text-xl text-gray-200 mb-4">
                                {{ $edition->keynote_company ? 'Keynote Speaker at ' . $edition->keynote_company : 'Keynote Speaker' }}
                            </div>
                            @if($edition->keynote_presentation_title)
                                <div class="font-bold italic text-white text-2xl mb-4">{{ $edition->keynote_presentation_title }}</div>
                            @endif
                            <div class="text-gray-200 text-lg">{{ $edition->keynote_description }}</div>
                        </div>
                    </div>
                </div>
            @endif

            <h2 class="text-3xl font-extrabold text-white text-left my-6">All Speakers</h2>

            <div class="w-full flex flex-col items-center">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 justify-items-center w-full">
                    @foreach($speakers as $speaker)
                        @php
                            $badge = optional($speaker->user->company)->is_sponsorship_approved
                                      ? $speaker->user->company->sponsorship_id
                                      : null;
                            $cardBorder = $badge
                                        ? 'border-' . strtolower($speaker->user->company->sponsorship->name)
                                        : 'border-gray-700';
                        @endphp
                        <a href="{{ route('speakers.show', $speaker->id) }}"
                           class="w-full bg-dark-card hover:bg-gray-900 transition-colors rounded-2xl border {{ $cardBorder }} shadow-md overflow-hidden
                                  flex flex-col items-center max-w-md mx-auto
                                  hover:bg hover:shadow-xl cursor-pointer">
                            <div class="p-8 pb-6 w-full flex flex-col items-center">
                                <div class="w-32 h-32 bg-gray-300 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                                        <img
                                            src="{{ $speaker->user->profile_photo_url }}"
                                            alt="{{ $speaker->user->name }}'s profile picture"
                                            class="object-cover w-full h-full"
                                        />
                                </div>
                                <div class="text-center w-full">
                                    <div class="flex items-center justify-center gap-2 mb-1">
                                        <span class="font-extrabold text-xl text-white">{{ $speaker->user->name }}</span>
                                        @if ($badge)
                                            <x-waitt.tag :textSize="'text-xs'" :title="$speaker->user->company->sponsorship->name" />
                                        @endif
                                    </div>
                                    <div class="text-gray-300 mb-1 text-base">
                                        {{ $speaker->user->company->name ?? 'Independent' }}
                                    </div>
                                    <div class="font-bold italic text-white text-base mb-1">
                                        {{ $speaker->presentation->name ?? '' }}
                                    </div>
                                    <div class="text-gray-400 text-sm">
                                        {{ Str::limit($speaker->presentation->description, 100) }}
                                    </div>
                                </div>
                            </div>
                        </a>
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
    </div>
</x-app-layout>

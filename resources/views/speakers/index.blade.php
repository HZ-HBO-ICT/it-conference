<x-app-layout>
    <div class="min-h-screen relative overflow-hidden mx-auto px-4 pt-14 pb-24">
        <!-- Colorful Blobs Background -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-1/2 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
            <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
        <h1 class="text-6xl font-extrabold text-left mb-12 uppercase tracking-wide text-waitt-yellow">
            Speakers
        </h1>
        <p class="text-left text-lg text-gray-200 mx-auto mb-5">
            Get inspired by industry experts, researchers, and changemakers as they share insights, stories, and forward-thinking ideas on the conference stage — offering fresh perspectives, practical knowledge, and bold visions for the future.
        </p>
        @if($speakers->isNotEmpty())
            {{-- Keynote Speaker --}}
            @if($edition->keynote_name)
                <div class="w-full mb-12">
                    <h2 class="text-3xl font-extrabold text-white text-left my-6">Keynote Speaker</h2>
                    <div class="flex flex-col md:flex-row bg-waitt-dark/70 backdrop-blur-sm border border-gray-400 rounded-2xl overflow-hidden shadow-lg">
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
                                        : 'border-slate-900';
                        @endphp
                        <div
                           class="w-full bg-waitt-dark/70 backdrop-blur-sm transition-colors rounded-2xl border {{ $cardBorder }} shadow-md overflow-hidden
                                  flex flex-col items-center max-w-md mx-auto
                                  shine-effect"
                           style="--shine-color: {{optional($speaker->user->company)->sponsorship ? $speaker->user->company->sponsorship->shine() : ''}}">
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
                                        {{ $speaker->user->company->name ?? $speaker->user->institution }}
                                    </div>
                                    <div class="font-bold italic text-white text-base mb-1">
                                        {{ $speaker->presentation->name ?? '' }}
                                    </div>
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
    </div>
</x-app-layout>

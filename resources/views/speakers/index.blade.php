@php
    use App\Models\Speaker;
    $keynote = $speakers->first(); // Assuming the first speaker is the keynote
@endphp

<x-app-layout>
    <div class="min-h-screen bg-[#0B1221] relative overflow-hidden">
        <!-- Background gradient effects -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-1/3 h-1/3 bg-gradient-to-br from-blue-400/20 to-transparent rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-gradient-to-bl from-purple-400/20 to-transparent rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-1/2 w-1/2 h-1/2 bg-gradient-to-t from-blue-500/20 to-transparent rounded-full blur-3xl transform -translate-x-1/2"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 py-24">
            <!-- Title -->
            <h1 class="text-[#E2FF32] text-7xl font-bold mb-24 text-center">SPEAKERS</h1>

            <!-- Keynote Speaker Section -->
            @if($keynote)
            <div class="mb-24">
                <h2 class="text-white text-4xl font-bold mb-12">Keynote Speaker</h2>
                <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="flex items-center justify-center p-8">
                            <div class="w-64 h-64 bg-gray-200 rounded-xl overflow-hidden">
                                <img src="{{ $keynote->user->profile_photo_url }}" 
                                     alt="Profile picture of {{ $keynote->user->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="p-8 flex flex-col justify-center">
                            <h3 class="text-white text-3xl font-bold mb-2">{{ $keynote->user->name }}</h3>
                            <p class="text-gray-400 text-lg mb-4">
                                @if($keynote->user->company)
                                    {{ $keynote->user->company->name }}
                                @endif
                            </p>
                            <h4 class="text-white text-xl font-semibold italic mb-4">{{ $keynote->presentation->title }}</h4>
                            <p class="text-gray-300">{{ $keynote->presentation->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- All Speakers Section -->
            <div>
                <h2 class="text-white text-4xl font-bold mb-12">All Speakers</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($speakers->skip(1) as $speaker)
                    <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="flex items-center justify-center p-6">
                                <div class="w-48 h-48 bg-gray-200 rounded-xl overflow-hidden">
                                    <img src="{{ $speaker->user->profile_photo_url }}" 
                                         alt="Profile picture of {{ $speaker->user->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div class="p-6 flex flex-col justify-center">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-white text-2xl font-bold">{{ $speaker->user->name }}</h3>
                                    @if($speaker->user->company && $speaker->user->company->sponsorship_id)
                                        @php
                                            $sponsorshipClass = match($speaker->user->company->sponsorship_id) {
                                                1 => 'bg-[#E2FF32] text-[#0B1221]',
                                                2 => 'bg-gray-300 text-gray-800',
                                                3 => 'bg-[#CD7F32] text-white',
                                                default => ''
                                            };
                                            $sponsorshipText = match($speaker->user->company->sponsorship_id) {
                                                1 => 'Gold',
                                                2 => 'Silver',
                                                3 => 'Bronze',
                                                default => ''
                                            };
                                        @endphp
                                        @if($sponsorshipText)
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $sponsorshipClass }}">
                                                {{ $sponsorshipText }}
                                            </span>
                                        @endif
                                    @endif
                                </div>
                                <p class="text-gray-400 mb-2">
                                    @if($speaker->user->company)
                                        {{ $speaker->user->company->name }}
                                    @endif
                                </p>
                                <h4 class="text-white text-lg font-semibold italic">{{ $speaker->presentation->title }}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
.bg-gradient-radial {
    background: radial-gradient(circle at center, var(--tw-gradient-stops));
}
</style>

@php
    use App\Models\Company;
    $goldSponsors = \App\Models\Company::whereHas('sponsorship', function($query) {
        $query->where('id', 1)->where('is_sponsorship_approved', true);
    })->get();
    $silverSponsors = \App\Models\Company::whereHas('sponsorship', function($query) {
        $query->where('id', 2)->where('is_sponsorship_approved', true);
    })->get();
    $bronzeSponsors = \App\Models\Company::whereHas('sponsorship', function($query) {
        $query->where('id', 3)->where('is_sponsorship_approved', true);
    })->get();
    $allCompanies = \App\Models\Company::all();
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
            <h1 class="text-[#E2FF32] text-7xl font-bold mb-12 text-center">COMPANIES</h1>

            <!-- Description -->
            <p class="text-white text-xl text-center mb-24 max-w-4xl mx-auto">
                We're proud to partner with leading technology companies who are driving innovation in the industry. Visit their booths at the conference to learn more about their products, services, and career opportunities.
            </p>

            <!-- Gold Sponsors -->
            <div class="mb-24">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-white text-4xl font-bold">Gold sponsor</h2>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-[#E2FF32] text-[#0B1221]">Gold</span>
                </div>
                @foreach($goldSponsors as $sponsor)
                <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 p-8">
                    <div class="h-16 bg-gray-200 rounded-lg mb-6 w-48"></div>
                    <h3 class="text-white text-2xl font-bold mb-2">{{ $sponsor->name }}</h3>
                    <p class="text-gray-400">{{ $sponsor->description }}</p>
                </div>
                @endforeach
            </div>

            <!-- Silver Sponsors -->
            <div class="mb-24">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-white text-4xl font-bold">Silver sponsors</h2>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-300 text-gray-800">Silver</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($silverSponsors as $sponsor)
                    <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 p-8">
                        <div class="h-16 bg-gray-200 rounded-lg mb-6 w-48"></div>
                        <h3 class="text-white text-2xl font-bold mb-2">{{ $sponsor->name }}</h3>
                        <p class="text-gray-400">{{ $sponsor->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Bronze Sponsors -->
            <div class="mb-24">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-white text-4xl font-bold">Bronze sponsors</h2>
                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-[#CD7F32] text-white">Bronze</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($bronzeSponsors as $sponsor)
                    <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 p-8">
                        <div class="h-16 bg-gray-200 rounded-lg mb-6 w-48"></div>
                        <h3 class="text-white text-2xl font-bold mb-2">{{ $sponsor->name }}</h3>
                        <p class="text-gray-400">{{ $sponsor->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- All Companies -->
            <div>
                <h2 class="text-white text-4xl font-bold mb-8">All companies</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($allCompanies as $company)
                    <div class="bg-[#0B1221]/40 backdrop-blur-sm rounded-2xl overflow-hidden border border-white/10 p-8">
                        <div class="h-16 bg-gray-200 rounded-lg mb-6 w-48"></div>
                        <h3 class="text-white text-2xl font-bold mb-2">{{ $company->name }}</h3>
                        <p class="text-gray-400">{{ $company->description }}</p>
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
@php
    $tiers = [
        1 => ['label' => 'Gold sponsor', 'badge' => 'Gold', 'color' => 'bg-yellow-400 text-yellow-900', 'border' => 'border-yellow-400'],
        2 => ['label' => 'Silver sponsors', 'badge' => 'Silver', 'color' => 'bg-gray-300 text-gray-900', 'border' => 'border-gray-300'],
        3 => ['label' => 'Bronze sponsors', 'badge' => 'Bronze', 'color' => 'bg-amber-900 text-amber-100', 'border' => 'border-amber-900'],
    ];
    $grouped = $companies->where('is_sponsorship_approved', true)->groupBy('sponsorship_id');
@endphp

<x-app-layout>
    <div class="min-h-screen bg-[#0a0e1a] py-16 px-4 sm:px-8 relative overflow-hidden">
        <!-- Colorful Blobs Background -->
        <div class="absolute top-[-120px] left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/4 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-1/3 left-1/5 w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl z-0"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl z-0"></div>
        <div class="absolute top-20 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl z-0"></div>
        <!-- End Blobs -->

        <div class="relative z-10">
            <h1 class="text-6xl font-extrabold text-center mb-4 uppercase"
                style="color: #ffe600; text-shadow: 0 0 2px #ffe600, 0 0 4px #ffe600; letter-spacing: 2px;">
                Companies
            </h1>
            <p class="text-center text-lg text-gray-200 max-w-3xl mx-auto mb-12">
                We're proud to partner with leading technology companies who are driving innovation in the industry. Visit their booths at the conference to learn more about their products, services, and career opportunities.
            </p>

            <div class="max-w-7xl mx-auto">
                @foreach($tiers as $tierId => $tier)
                    @if(isset($grouped[$tierId]) && $grouped[$tierId]->count())
                        <div class="mb-12">
                            <div class="flex items-center gap-4 mb-6">
                                <h2 class="text-3xl font-extrabold text-white">{{ $tier['label'] }}</h2>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $tier['color'] }}">{{ $tier['badge'] }}</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($grouped[$tierId] as $company)
                                    <a href="{{ route('companies.show', $company) }}" class="block hover:scale-[1.02] transition-transform">
                                        <div class="border rounded-xl p-8 bg-[#101426] {{ $tier['border'] }} flex flex-col items-start min-h-[220px]">
                                            <div class="w-full flex justify-center mb-6">
                                                @if($company->logo_path)
                                                    <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="h-24 object-contain rounded bg-white p-2 shadow" style="max-width: 220px;" />
                                                @else
                                                    <div class="h-24 w-48 bg-gray-700 rounded flex items-center justify-center">
                                                        <span class="text-gray-400">Logo</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-extrabold text-2xl text-white mb-1">{{ $company->name }}</div>
                                                <div class="text-gray-300 text-base">{{ $company->description }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- All companies section --}}
                @php
                    $allCompanies = $companies->where('is_sponsorship_approved', true);
                @endphp
                @if($allCompanies->count())
                    <div class="mb-12">
                        <h2 class="text-3xl font-extrabold text-white mb-6">All companies</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($allCompanies as $company)
                                <a href="{{ route('companies.show', $company) }}" class="block hover:scale-[1.02] transition-transform">
                                    <div class="border rounded-xl p-8 bg-[#101426] flex flex-col items-start min-h-[220px]">
                                        <div class="w-full flex justify-center mb-6">
                                            @if($company->logo_path)
                                                <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="h-24 object-contain rounded bg-white p-2 shadow" style="max-width: 220px;" />
                                            @else
                                                <div class="h-24 w-48 bg-gray-700 rounded flex items-center justify-center">
                                                    <span class="text-gray-400">Logo</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-extrabold text-2xl text-white mb-1">{{ $company->name }}</div>
                                            <div class="text-gray-300 text-base">{{ $company->description }}</div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            @if($companies->where('is_sponsorship_approved', true)->count() === 0)
                <div class="bg-[#101426] rounded-xl py-8 mt-12">
                    <p class="text-center text-2xl font-bold text-white">
                        There are no companies available right now.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

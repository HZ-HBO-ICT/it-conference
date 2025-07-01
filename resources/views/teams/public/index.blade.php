@php
    $tiers = [
        1 => ['label' => 'Gold sponsor', 'badge' => 'Gold', 'color' => 'bg-yellow-400 text-yellow-900', 'border' => 'border-yellow-400'],
        2 => ['label' => 'Silver sponsors', 'badge' => 'Silver', 'color' => 'bg-gray-300 text-gray-900', 'border' => 'border-gray-300'],
        3 => ['label' => 'Bronze sponsors', 'badge' => 'Bronze', 'color' => 'bg-amber-900 text-amber-100', 'border' => 'border-amber-900'],
        0 => ['label' => 'Other companies', 'badge' => '', 'color' => 'bg-cyan-900 text-cyan-100', 'border' => 'border-cyan-900'],
    ];
    $grouped = $companies->groupBy('sponsorship_id');
@endphp

<x-app-layout>
    <div class="min-h-screen relative overflow-hidden mx-auto px-4 pt-14 pb-24">
        <!-- Colorful Blobs Background -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-32 left-[-120px] w-96 h-96 bg-blue-500 opacity-25 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 right-[-100px] w-80 h-80 bg-yellow-300 opacity-20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-32 left-1/3 w-72 h-72 bg-purple-500 opacity-30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-40 w-80 h-80 bg-pink-400 opacity-20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-green-400 opacity-25 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-[20%] w-64 h-64 bg-red-400 opacity-35 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-indigo-400 opacity-30 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-1/3 w-80 h-80 bg-teal-400 opacity-20 rounded-full blur-3xl"></div>
        </div>
        <!-- End Blobs -->

        <div class="relative z-10 max-w-7xl mx-auto">
            <h1 class="text-6xl font-extrabold text-left mb-4 uppercase tracking-wide mb-10 text-waitt-yellow">
                Companies
            </h1>
            <p class="text-left text-lg text-gray-200 mx-auto mb-5">
                We're proud to partner with leading technology companies who are driving innovation in the industry. Visit their booths at the conference to learn more about their products, services, and career opportunities.
            </p>

            <div class="max-w-7xl mx-auto">
                @foreach($grouped as $companyGroup)
                    <div class="mb-12">
                        @if ($companyGroup->first()->sponsorship)
                            <div class="mb-6">
                                <div class="flex items-center gap-4 mb-6">
                                    <h2 class="text-3xl font-extrabold text-white">{{ ucfirst($companyGroup->first()->sponsorship->name) }} sponsor</h2>
                                    <x-waitt.tag :title="$companyGroup->first()->sponsorship->name"/>
                                </div>
                            </div>
                        @else
                            <div class="mb-12">
                                <div class="flex items-center gap-4 mb-6">
                                    <h2 class="text-3xl font-extrabold text-white">Other companies</h2>
                                </div>
                            </div>
                        @endif
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($companyGroup as $company)
                                    <a href="{{ route('companies.show', $company) }}" class="block h-full transition-transform">
                                        <div class="border rounded-xl p-8 bg-dark-card hover:bg-gray-900 transition-colors h-full flex flex-col {{ $company->sponsorship ? 'border-' . $company->sponsorship->name : 'border-gray-700' }}">
                                            <div class="w-full flex justify-center mb-6">
                                                @if($company->logo_path)
                                                    <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="h-24 object-contain rounded bg-white p-2 shadow" style="max-width: 220px;" />
                                                @else
                                                    <div class="h-24 w-48 bg-gray-700 rounded flex items-center justify-center">
                                                        <span class="text-gray-400">Logo</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 flex flex-col">
                                                <div class="font-extrabold text-2xl text-white mb-1 line-clamp-2 break-words" title="{{ $company->name }}">
                                                    {{ $company->name }}
                                                </div>
                                                <div class="text-gray-300 text-base line-clamp-3 break-words overflow-hidden">
                                                    {{ $company->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                    </div>
                @endforeach
            </div>
            @if($companies->where('is_approved')->count() === 0)
                <div class="bg-[#101426] rounded-xl py-8 mt-12">
                    <p class="text-center text-2xl font-bold text-white">
                        There are no companies available right now.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

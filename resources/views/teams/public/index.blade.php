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
                                        <div class="border shine-effect rounded-xl p-8 bg-waitt-dark/70 backdrop-blur-sm transition-colors h-full flex flex-col {{ $company->sponsorship ? 'border-' . $company->sponsorship->name : 'border-slate-900' }}"
                                             style="--shine-color: {{$company->sponsorship ? $company->sponsorship->shine() : ''}}">
                                            <div class="w-full flex justify-center mb-6">
                                                @if($company->logo_path)
                                                    <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="h-28 w-3/4 bg-waitt-dark object-contain rounded p-2 shadow" />
                                                @else
                                                    <div class="h-28 w-4/5 bg-waitt-dark rounded flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-300 size-24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                                        </svg>
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

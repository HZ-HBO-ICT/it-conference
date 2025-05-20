@php
    $tiers = [
        1 => ['label' => 'Gold', 'color' => 'bg-yellow-400 text-yellow-900'],
        2 => ['label' => 'Silver', 'color' => 'bg-gray-300 text-gray-900'],
        3 => ['label' => 'Bronze', 'color' => 'bg-amber-900 text-amber-100'],
    ];
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

        <div class="relative z-10 max-w-7xl mx-auto flex flex-col lg:flex-row gap-12 min-h-[80vh] justify-center">
            <!-- Left Card -->
            <div class="bg-[#101426] border border-gray-400 rounded-xl p-8 w-full max-w-md flex flex-col items-center shadow-lg">
                @if($company->logo_path)
                    <img src="{{ url('storage/' . $company->logo_path) }}" alt="Logo of {{ $company->name }}" class="h-24 w-48 object-contain rounded bg-white p-2 shadow mb-6" />
                @else
                    <div class="h-24 w-48 bg-gray-700 rounded flex items-center justify-center mb-6">
                        <span class="text-gray-400">Logo</span>
                    </div>
                @endif
                <div class="font-extrabold text-2xl text-white mb-2 text-center">{{ $company->name }}</div>
                @if(isset($tiers[$company->sponsorship_id]))
                    <span class="px-3 py-1 rounded-full text-sm font-semibold mb-4 {{ $tiers[$company->sponsorship_id]['color'] }}">{{ $tiers[$company->sponsorship_id]['label'] }}</span>
                @endif
                <div class="flex items-center text-gray-200 mb-2 w-full text-lg font-semibold"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $company->city ?? 'Location not specified' }}</div>
                <div class="flex items-center text-gray-200 mb-2 w-full text-lg font-semibold"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 01-8 0m8 0a4 4 0 00-8 0m8 0V8a4 4 0 00-8 0v4m8 0v4a4 4 0 01-8 0v-4"/></svg>{{ $company->email ?? 'Email not specified' }}</div>
                <div class="flex items-center text-gray-200 mb-6 w-full text-lg font-semibold"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 17v2a2 2 0 002 2h14a2 2 0 002-2v-2M16 11V7a4 4 0 00-8 0v4"/></svg>{{ $company->employees ?? 'Employees not specified' }}</div>
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank" class="w-full mt-auto"><button class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-lg transition">Visit website</button></a>
                @endif
            </div>

            <!-- Right Section -->
            <div class="flex-1 flex flex-col gap-8 text-white">
                <div>
                    <h2 class="text-2xl font-extrabold mb-2">About</h2>
                    <p class="text-lg text-gray-200">{{ $company->description }}</p>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold mb-2">Internship opportunities</h2>
                    @php
                        $internships = $company->internshipAttributes()->tracks()->pluck('value');
                    @endphp
                    @if($internships->count())
                        <ul class="list-disc ml-6 text-lg text-gray-200">
                            @foreach($internships as $track)
                                <li>{{ $track }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-lg text-gray-400">No internship opportunities specified.</p>
                    @endif
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold mb-2">Meet Us at the Conference</h2>
                    <p class="text-lg text-gray-200">Visit our booth at the conference to learn more about {{ $company->name }} and the opportunities we offer. Our team will be available to answer your questions and discuss potential career paths.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

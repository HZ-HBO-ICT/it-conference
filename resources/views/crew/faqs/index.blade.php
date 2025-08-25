<x-hub-layout>
    <div class="min-h-screen relative overflow-hidden py-6 sm:py-8 px-4 sm:px-6 md:px-8 bg-waitt-dark">
        <!-- Decorative Blobs Background -->
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
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 sm:mb-8 gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-2">{{ __('Frequently Asked Questions (FAQs)') }}</h2>
                    <p class="text-base sm:text-lg text-gray-300">Manage frequently asked questions and answers</p>
                </div>
                @can('create', \App\Models\Room::class)
                    <a href="{{route('moderator.faqs.create')}}" class="px-4 sm:px-6 py-2 sm:py-3 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-xl text-sm sm:text-lg shadow transition flex items-center gap-2 w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 4v16m8-8H4"/>
                        </svg>
                        Add a new FAQ
                    </a>
                @endcan
            </div>
            
            <!-- FAQs Table -->
            <div class="overflow-x-auto responsive-table">
                <table class="min-w-full overflow-hidden shadow-2xl rounded-2xl bg-white/5 backdrop-blur-md">
                    <thead class="bg-white/10">
                        <tr>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Frequently Asked Question</th>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider hidden sm:table-cell">Created At</th>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                            <tr class="hover:bg-white/10 transition cursor-pointer">
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-white font-semibold text-sm sm:text-base">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-waitt-pink-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                        </svg>
                                        {{$faq->question}}
                                    </div>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-gray-200 text-sm hidden sm:table-cell">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $faq->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap flex gap-2 sm:gap-4 items-center">
                                    <a href="{{ route('moderator.faqs.show', $faq) }}" class="text-white hover:text-cyan-400 transition-colors" title="View">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('moderator.faqs.edit', $faq) }}" class="text-white hover:text-yellow-400 transition-colors" title="Edit">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 sm:px-6 py-6 sm:py-8 text-center text-gray-300 text-sm sm:text-base">There are currently no FAQs.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-hub-layout>

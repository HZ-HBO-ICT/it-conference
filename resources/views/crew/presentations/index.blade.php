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
        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 sm:mb-8 gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-2">Presentations</h2>
                    <p class="text-base sm:text-lg text-gray-300">Manage presentation submissions and scheduling</p>
                </div>
                <a href="{{ route('moderator.presentations.create') }}" class="px-4 sm:px-6 py-2 sm:py-3 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-xl text-sm sm:text-lg shadow transition flex items-center gap-2 w-full sm:w-auto justify-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Presentation
                </a>
            </div>
            
            <!-- Search and Filters -->
            <div class="mb-6 space-y-4">
                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" 
                           id="presentationSearch" 
                           placeholder="Search presentations..." 
                           class="w-full px-3 sm:px-4 py-2 sm:py-3 pl-8 sm:pl-10 bg-white/10 border border-gray-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent text-sm sm:text-base">
                    <svg class="absolute left-2 sm:left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                
                <!-- Column Filters -->
                <div class="flex flex-wrap gap-2">
                    <select id="statusFilter" class="px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-waitt-pink-500">
                        <option value="">All Statuses</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                    </select>
                    
                    <select id="speakerFilter" class="px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-waitt-pink-500">
                        <option value="">All Speakers</option>
                        @foreach($presentations->pluck('speaker')->filter()->unique() as $speaker)
                            <option value="{{ $speaker }}">{{ $speaker }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Presentations Table -->
            <div class="overflow-x-auto responsive-table">
                <table class="min-w-full overflow-hidden shadow-2xl rounded-2xl bg-white/5 backdrop-blur-md">
                    <thead class="bg-white/10">
                        <tr>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Title</th>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider hidden sm:table-cell">Speaker</th>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider hidden md:table-cell">Time Slot</th>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider hidden lg:table-cell">Updated At</th>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Status</th>
                            <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($presentations as $presentation)
                            <tr class="hover:bg-white/10 transition cursor-pointer">
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-white font-semibold text-sm sm:text-base">{{ $presentation->name }}</td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-gray-200 text-sm hidden sm:table-cell">{{ $presentation->speaker ?? '-' }}</td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-gray-200 text-sm hidden md:table-cell">{{ $presentation->time_slot ?? '-' }}</td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-gray-200 text-sm hidden lg:table-cell">{{ $presentation->updated_at->format('d/m/Y H:i') }}</td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                    @if($presentation->is_approved)
                                        <span class="bg-green-500 text-white px-2 sm:px-4 py-1 rounded-full text-xs sm:text-sm font-semibold">Approved</span>
                                    @else
                                        <span class="bg-yellow-500 text-white px-2 sm:px-4 py-1 rounded-full text-xs sm:text-sm font-semibold">Pending</span>
                                    @endif
                                </td>
                                <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap flex gap-2 sm:gap-4 items-center">
                                    <a href="{{ route('moderator.presentations.show', $presentation) }}" class="text-white hover:text-cyan-400 transition-colors" title="View">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('moderator.presentations.edit', $presentation) }}" class="text-white hover:text-yellow-400 transition-colors" title="Edit">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 sm:px-6 py-6 sm:py-8 text-center text-gray-300 text-sm sm:text-base">There are currently no presentations.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($presentations->hasPages())
                <div class="mt-6">
                    {{ $presentations->links() }}
                </div>
            @endif
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('presentationSearch');
            const statusFilter = document.getElementById('statusFilter');
            const speakerFilter = document.getElementById('speakerFilter');
            const tableRows = document.querySelectorAll('tbody tr');
            
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();
                const speakerValue = speakerFilter.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const title = row.querySelector('td:first-child').textContent.toLowerCase();
                    const speaker = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const status = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';
                    
                    const matchesSearch = title.includes(searchTerm) || speaker.includes(searchTerm);
                    const matchesStatus = !statusValue || status.includes(statusValue);
                    const matchesSpeaker = !speakerValue || speaker.includes(speakerValue);
                    
                    if (matchesSearch && matchesStatus && matchesSpeaker) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            speakerFilter.addEventListener('change', filterTable);
        });
    </script>
</x-hub-layout>

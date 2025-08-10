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
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white mb-2">Companies</h2>
                    <p class="text-base sm:text-lg text-gray-300">Manage company registrations and approvals</p>
                </div>
                <a href="{{ route('moderator.companies.create') }}" class="px-4 sm:px-6 py-2 sm:py-3 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-xl text-sm sm:text-lg shadow transition flex items-center gap-2 w-full sm:w-auto justify-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Company
                </a>
            </div>
            
            <!-- Search and Filters -->
            <div class="mb-6 space-y-4">
                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" 
                           id="companySearch" 
                           placeholder="Search companies..." 
                           class="w-full px-3 sm:px-4 py-2 sm:py-3 pl-8 sm:pl-10 bg-white/10 border border-gray-600 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent text-sm sm:text-base">
                    <svg class="absolute left-2 sm:left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                
                <!-- Column Filters -->
                <div class="flex flex-wrap gap-2">
                    <select id="statusFilter" class="px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-waitt-pink-500">
                        <option value="">All Statuses</option>
                        <option value="awaiting_approval">Awaiting Approval</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="feedback_given">Feedback Given</option>
                        <option value="not_requested">Not Requested</option>
                    </select>
                    
                    <select id="boothFilter" class="px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-waitt-pink-500">
                        <option value="">All Booth Statuses</option>
                        <option value="yes">Has Booth</option>
                        <option value="no">No Booth</option>
                        <option value="requested">Booth Requested</option>
                    </select>
                    
                    <select id="sponsorshipFilter" class="px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-waitt-pink-500">
                        <option value="">All Sponsorship Statuses</option>
                        <option value="awaiting_approval">Awaiting Approval</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="not_requested">Not Requested</option>
                    </select>
                </div>
            </div>
            
            <!-- Companies Table -->
            <div class="overflow-x-auto responsive-table">
                <table class="min-w-full overflow-hidden shadow-2xl rounded-2xl bg-white/5 backdrop-blur-md">
                    <thead class="bg-white/10">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Company</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider hidden sm:table-cell">Representative</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider hidden md:table-cell">Booth</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider hidden lg:table-cell">Sponsorship</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Status</th>
                        <th class="px-3 sm:px-6 py-3 sm:py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($companies as $company)
                        <tr class="hover:bg-white/10 transition cursor-pointer">
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-white font-semibold flex items-center gap-2 sm:gap-3 text-sm sm:text-base">
                                @if($company->logo_path)
                                    <img class="w-6 h-6 sm:w-8 sm:h-8 rounded-full object-cover" src="{{ url('storage/'. $company->logo_path) }}" alt="Logo of {{$company->name}}">
                                @else
                                    <span class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gray-700 flex items-center justify-center text-gray-300 font-bold text-xs sm:text-sm">{{ strtoupper(substr($company->name,0,1)) }}</span>
                                @endif
                                {{ $company->name }}
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-gray-200 text-sm hidden sm:table-cell">
                                @if($company->representative)
                                    <div>
                                        <div class="font-medium">{{ $company->representative->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $company->representative->email }}</div>
                                    </div>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-gray-200 text-sm hidden md:table-cell">
                                @if($company->booth)
                                    @if($company->booth->approval_status === 'approved')
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-500 text-white">Yes</span>
                                    @elseif($company->booth->approval_status === 'awaiting_approval')
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white">Requested</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-500 text-white">Rejected</span>
                                    @endif
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-500 text-white">No</span>
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-gray-200 text-sm hidden lg:table-cell">
                                @if($company->sponsorship_approval_status)
                                    @php
                                        $sponsorshipStatus = strtolower($company->sponsorship_approval_status);
                                        $sponsorshipColors = [
                                            'approved' => 'bg-green-500',
                                            'awaiting_approval' => 'bg-yellow-500',
                                            'rejected' => 'bg-red-500',
                                            'not_requested' => 'bg-gray-500',
                                        ];
                                        $sponsorshipLabels = [
                                            'approved' => 'Approved',
                                            'awaiting_approval' => 'Awaiting Approval',
                                            'rejected' => 'Rejected',
                                            'not_requested' => 'Not Requested',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold text-white {{ $sponsorshipColors[$sponsorshipStatus] ?? 'bg-gray-500' }}">
                                        {{ $sponsorshipLabels[$sponsorshipStatus] ?? ucfirst($sponsorshipStatus) }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-500 text-white">Not Requested</span>
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                @php
                                    $status = strtolower($company->approval_status ?? 'pending');
                                    $badgeColors = [
                                        'approved' => 'bg-green-500',
                                        'awaiting_approval' => 'bg-yellow-500',
                                        'rejected' => 'bg-red-500',
                                        'feedback_given' => 'bg-blue-500',
                                        'not_requested' => 'bg-gray-500',
                                    ];
                                    $statusLabels = [
                                        'approved' => 'Approved',
                                        'awaiting_approval' => 'Awaiting Approval',
                                        'rejected' => 'Rejected',
                                        'feedback_given' => 'Feedback Given',
                                        'not_requested' => 'Not Requested',
                                    ];
                                @endphp
                                <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-bold text-white {{ $badgeColors[$status] ?? 'bg-gray-500' }}">
                                    {{ $statusLabels[$status] ?? ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap flex gap-2 sm:gap-3 items-center">
                                <a href="{{ route('moderator.companies.show', $company) }}" class="text-white hover:text-cyan-400 transition-colors" title="View">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('moderator.companies.edit', $company) }}" class="text-white hover:text-yellow-400 transition-colors" title="Edit">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('moderator.companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white hover:text-red-500 transition-colors" title="Delete">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 sm:px-6 py-6 sm:py-8 text-center text-gray-300 text-sm sm:text-base">There are currently no companies.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($companies->hasPages())
                <div class="mt-6">
                    {{ $companies->links() }}
                </div>
            @endif
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('companySearch');
            const statusFilter = document.getElementById('statusFilter');
            const boothFilter = document.getElementById('boothFilter');
            const sponsorshipFilter = document.getElementById('sponsorshipFilter');
            const tableRows = document.querySelectorAll('tbody tr');
            
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();
                const boothValue = boothFilter.value.toLowerCase();
                const sponsorshipValue = sponsorshipFilter.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const companyName = row.querySelector('td:first-child').textContent.toLowerCase();
                    const representative = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const boothStatus = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                    const sponsorshipStatus = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';
                    const status = row.querySelector('td:nth-child(5)')?.textContent.toLowerCase() || '';
                    
                    const matchesSearch = companyName.includes(searchTerm) || representative.includes(searchTerm);
                    const matchesStatus = !statusValue || status.includes(statusValue);
                    const matchesBooth = !boothValue || boothStatus.includes(boothValue);
                    const matchesSponsorship = !sponsorshipValue || sponsorshipStatus.includes(sponsorshipValue);
                    
                    if (matchesSearch && matchesStatus && matchesBooth && matchesSponsorship) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            boothFilter.addEventListener('change', filterTable);
            sponsorshipFilter.addEventListener('change', filterTable);
        });
    </script>
</x-hub-layout>

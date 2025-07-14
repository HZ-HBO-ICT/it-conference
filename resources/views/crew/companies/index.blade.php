<x-hub-layout>
    <div class="min-h-screen relative overflow-hidden py-10 px-8 bg-waitt-dark">
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
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-4xl font-extrabold text-white mb-2">Companies</h2>
                    <p class="text-lg text-gray-300">Manage company registrations and approvals</p>
                </div>
                <a href="{{ route('moderator.companies.create') }}" class="px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-bold rounded-xl text-lg shadow transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v16m8-8H4"/></svg>
                    Add Company
                </a>
            </div>
            <!-- Summary Cards -->
            <div class="flex gap-6 mb-10">
                <div class="flex-1 bg-gradient-to-r from-green-900/80 to-green-700/60 rounded-2xl p-6 flex flex-col items-start shadow">
                    <span class="text-green-300 font-bold text-lg mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-2xl font-bold">Approved</span>
                    </span>
                    <span class="text-4xl font-extrabold text-white">{{ $companies->where('approval_status', 'approved')->count() }}</span>
                </div>
                <div class="flex-1 bg-gradient-to-r from-orange-900/80 to-orange-700/60 rounded-2xl p-6 flex flex-col items-start shadow">
                    <span class="text-orange-300 font-bold text-lg mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/></svg>
                        <span class="text-2xl font-bold">Pending</span>
                    </span>
                    <span class="text-4xl font-extrabold text-white">{{ $companies->where('approval_status', 'awaiting_approval')->count() }}</span>
                </div>
                <div class="flex-1 bg-gradient-to-r from-purple-900/80 to-purple-700/60 rounded-2xl p-6 flex flex-col items-start shadow">
                    <span class="text-purple-300 font-bold text-lg mb-1 flex items-center gap-2">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/></svg>
                        <span class="text-2xl font-bold">Total</span>
                    </span>
                    <span class="text-4xl font-extrabold text-white">{{ $companies->count() }}</span>
                </div>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="min-w-full overflow-hidden shadow-2xl">
                    <thead class="bg-white/10">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Booth</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Employees</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($companies as $company)
                        <tr class="hover:bg-white/10 transition cursor-pointer">
                            <td class="px-6 py-4 whitespace-nowrap text-white font-semibold flex items-center gap-3">
                                @if($company->logo_path)
                                    <img class="w-8 h-8 rounded-full object-cover" src="{{ url('storage/'. $company->logo_path) }}" alt="Logo of {{$company->name}}">
                                @else
                                    <span class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-gray-300 font-bold">{{ strtoupper(substr($company->name,0,1)) }}</span>
                                @endif
                                {{ $company->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{ $company->contact_email ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{ $company->booth_number ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{ $company->employees_count ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $status = strtolower($company->approval_status ?? 'pending');
                                    $badgeColors = [
                                        'approved' => 'bg-green-500',
                                        'pending' => 'bg-yellow-500',
                                        'rejected' => 'bg-red-500',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold text-white {{ $badgeColors[$status] ?? 'bg-gray-500' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-3 items-center">
                                <a href="{{ route('moderator.companies.show', $company) }}" class="hover:text-cyan-400" title="View"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                                <a href="{{ route('moderator.companies.edit', $company) }}" class="hover:text-yellow-400" title="Edit"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h2v2a2 2 0 002 2h2a2 2 0 002-2v-2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2v-2a2 2 0 00-2-2h-2a2 2 0 00-2 2v2H7a2 2 0 00-2 2v2a2 2 0 002 2h2v2a2 2 0 002 2h2a2 2 0 002-2v-2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2v-2a2 2 0 00-2-2h-2a2 2 0 00-2 2v2z"/></svg></a>
                                <form action="{{ route('moderator.companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hover:text-red-500" title="Delete"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-300">There are currently no companies.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-hub-layout>

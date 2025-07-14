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
                    <h2 class="text-4xl font-extrabold text-white mb-2">Booths</h2>
                    <p class="text-lg text-gray-300">Manage company booths and assignments</p>
                </div>
                <a href="{{ route('moderator.booths.create') }}" class="px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-bold rounded-xl text-lg shadow transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v16m8-8H4"/></svg>
                    Add Booth
                </a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="min-w-full overflow-hidden shadow-2xl rounded-2xl bg-white/5 backdrop-blur-md">
                    <thead class="bg-white/10">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Company Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Created At</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($booths as $booth)
                            <tr class="hover:bg-white/10 transition cursor-pointer">
                                <td class="px-6 py-4 whitespace-nowrap text-white font-semibold">{{$booth->company->name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{ $booth->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booth->is_approved)
                                        <span class="bg-green-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Approved</span>
                                    @else
                                        <span class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-semibold">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex gap-4 items-center">
                                    <a href="{{ route('moderator.booths.show', $booth) }}" class="text-waitt-yellow hover:text-waitt-yellow" title="View"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                                    <a href="{{ route('moderator.booths.edit', $booth) }}" class="text-waitt-yellow hover:text-waitt-yellow" title="Edit"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536M9 11l6 6M3 21h6l11-11a2.828 2.828 0 00-4-4L5 17v4z"/></svg></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-300">There are currently no booths.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pt-2">
                    {{ $booths->links() }}
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>

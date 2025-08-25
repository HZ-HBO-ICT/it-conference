    <x-list-section class="bg-waitt-dark bg-opacity-100">
        <x-slot name="content">
            <!-- Role Summary Cards -->
            @php
                $roleCounts = [];
                $roleColors = [
                    'participant' => 'bg-blue-400/50',
                    'event organizer' => 'bg-green-400/50',
                    'company representative' => 'bg-purple-400/50',
                    'company member' => 'bg-orange-300/50',
                    // fallback color
                    'default' => 'bg-gray-500/30',
                ];
                foreach ($users as $user) {
                    foreach ($user->getRoleNames() as $role) {
                        $roleCounts[$role] = ($roleCounts[$role] ?? 0) + 1;
                    }
                }
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @foreach($roleCounts as $role => $count)
                    @php
                        $roleKey = strtolower(str_replace(['_', ' '], [' ', ' '], $role));
                        $colorClass = $roleColors[$roleKey] ?? $roleColors['default'];
                    @endphp
                    <div class="rounded-2xl p-8 shadow text-white flex flex-col items-center justify-center h-40 backdrop-blur-md {{ $colorClass }}">
                        <div class="text-lg font-bold capitalize text-center w-full">{{ str_replace('_', ' ', $role) }}</div>
                        <div class="text-4xl font-extrabold mt-2 text-center w-full">{{ $count }}</div>
                    </div>
                @endforeach
            </div>
            <!-- Filter Box -->
            <div class="bg-white/5 backdrop-blur-md rounded-lg p-4 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-white">Filter users</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-200">Role</label>
                        <select id="role" name="role" wire:model="role" wire:change="roleChanged"
                                class="mt-1 bg-white/10 text-white block w-full py-2 px-3 border border-gray-700 rounded-md shadow-xs focus:outline-hidden focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">All Roles</option>
                            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                            @endforeach
                            <option value="speaker">Speaker</option>
                        </select>
                    </div>
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-200">Company/Institution</label>
                        <input name='company' wire:model.live="institution" type="text"
                               class="mt-1 block w-full py-2 px-3 border border-gray-700 bg-white/10 text-white rounded-md shadow-xs focus:outline-hidden focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-200">Name/Email</label>
                        <input name='email' wire:model.live="email" type="text"
                               class="mt-1 block w-full py-2 px-3 border border-gray-700 bg-white/10 text-white rounded-md shadow-xs focus:outline-hidden focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="flex items-end">
                        <button wire:click="export" class="w-full bg-green-500 text-white py-2 px-4 rounded-md shadow-xs hover:bg-green-700">Export to CSV</button>
                    </div>
                </div>
                <div class="flex items-center text-sm mt-4 text-gray-200 cursor-pointer" wire:click="clearFilters">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>Clear filters
                </div>
            </div>
            <!-- Users Table -->
            <div class="overflow-x-auto flex-1">
                <table class="min-w-full overflow-hidden shadow-2xl rounded-2xl bg-white/5 backdrop-blur-md">
                    <thead class="bg-white/10">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Ticket Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-200 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-white/10 transition cursor-pointer">
                            <td class="px-6 py-4 whitespace-nowrap text-white font-semibold">{{$user->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{$user->email}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{$user->mainRoles()->implode(', ')}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{$user->company ? $user->company->name : $user->institution}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->status === 'active')
                                    <span class="bg-emerald-700/80 text-emerald-200 font-bold rounded-full px-4 py-1 text-sm">Active</span>
                                @else
                                    <span class="bg-orange-700/80 text-orange-200 font-bold rounded-full px-4 py-1 text-sm">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $ticketStatus = $user->ticket_status;
                                    $colorClass = match($ticketStatus['color']) {
                                        'green' => 'bg-green-500/80 text-green-100',
                                        'yellow' => 'bg-yellow-500/80 text-yellow-100',
                                        'red' => 'bg-red-500/80 text-red-100',
                                        'sky' => 'bg-sky-500/80 text-sky-100',
                                        default => 'bg-gray-500/80 text-gray-100',
                                    };
                                @endphp
                                <span class="px-4 py-1 rounded-full text-sm font-semibold {{ $colorClass }}">
                                    {{ $ticketStatus['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-4 items-center">
                                <a href="mailto:{{$user->email}}" class="text-blue-300 hover:text-blue-400" title="Email"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-300">No users found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-list-section>

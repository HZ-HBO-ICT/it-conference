<x-waitt.list-section>
    <x-slot name="content">
        <div class="rounded-lg mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <x-waitt.label for="role">Role</x-waitt.label>
                    <select id="role" name="role" wire:model="role" wire:change="roleChanged"
                            class="mt-1 block w-full py-2 px-3 border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs">
                        <option value="">All Roles</option>
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                        @endforeach
                        <option value="speaker">Speaker</option>
                    </select>
                </div>
                <div>
                    <x-waitt.label for="company">Company/Institution</x-waitt.label>
                    <x-waitt.input name='company' wire:model.live="institution" type="text"
                                   class="mt-1 block w-full py-2 px-3"/>
                </div>
                <div>
                    <x-waitt.label for="email">Name/Email</x-waitt.label>
                    <x-waitt.input name='email' wire:model.live="email" type="text"
                                   class="mt-1 block w-full py-2 px-3"/>
                </div>
                <div class="flex items-end">
                    <button wire:click="export"
                            class="w-full bg-waitt-pink text-white py-2 px-4 rounded-md shadow-xs hover:bg-waitt-pink-600 transition-all hover:cursor-pointer">
                        Export to CSV
                    </button>
                </div>
            </div>
            <div class="flex items-center text-sm mt-4 cursor-pointer text-gray-200"
                 wire:click="clearFilters">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
                Clear filters
            </div>
        </div>
        <table class="w-full divide-gray-200 dark:divide-gray-700 text-left">
            <thead class="bg-white/5 rounded">
            <tr>
                <th scope="col"
                    class="rounded-tl-md px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                    Name
                </th>
                <th scope="col"
                    class="px-2 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                    Email
                </th>
                <th scope="col"
                    class="px-2 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                    Company/Institution
                </th>
                <th scope="col"
                    class="px-2 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                    Role
                </th>
                <th scope="col"
                    class="rounded-tr-md px-2 py-2 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                    Ticket Status
                </th>
            </tr>
            </thead>
            <tbody class="divide-y-2 divide-gray-700/10">
            @forelse($users as $user)
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-200 w-1/5">{{$user->name}}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-300 w-1/5">{{$user->email}}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-300 w-1/5">{{$user->company ? $user->company->name : $user->institution}}</td>
                    <td class="px-2 py-4 text-sm w-1/5 text-gray-300">{{$user->mainRoles()->implode(', ')}}</td>
                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-300 w-1/5">
                        <x-waitt.tag :textSize="'text-xs'" :uppercase="false" :title="$user->ticket_status['status']" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No users
                        found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </x-slot>
</x-waitt.list-section>

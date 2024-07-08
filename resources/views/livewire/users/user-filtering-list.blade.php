<x-list-section>
    <x-slot name="content">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-6">
            <h2 class="text-xl font-semibold mb-4">Filter users</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Role</label>
                    <select id="role" name="role" wire:model="role" wire:change="roleChanged"
                            class="mt-1 dark:bg-gray-700 block w-full py-2 px-3 border border-gray-300 dark:border-gray-800 bg-white rounded-md shadow-sm focus:outline-none focus:ring-apricot-peach-500 focus:border-apricot-peach-500 sm:text-sm">
                        <option value="">All Roles</option>
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Company/Institution</label>
                    <input name='company' wire:model.live="institution" type="text"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-800 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-apricot-peach-500 focus:border-apricot-peach-500 sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name/Email</label>
                    <input name='email' wire:model.live="email" type="text"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-800 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-apricot-peach-500 focus:border-apricot-peach-500 sm:text-sm">
                </div>
                <div class="flex items-end">
                    <button wire:click="export" class="w-full bg-green-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-green-700">Export to CSV</button>
                </div>
            </div>
            <div class="flex items-center text-sm mt-4 text-gray-500 cursor-pointer dark:text-gray-200" wire:click="clearFilters">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>Clear filters
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-900">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/4">Name
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/4">Email
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/4">
                    Company/Institution
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-300 tracking-wider w-1/4">Role
                </th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
            @forelse($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200 w-1/4">{{$user->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 w-1/4">{{$user->email}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 w-1/4">{{$user->company ? $user->company->name : $user->institution}}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 w-1/4 dark:text-gray-300">{{$user->mainRoles()->implode(', ')}}</td>
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
</x-list-section>

<x-list-section>
    @can('create', \App\Models\Room::class)
        <x-slot name="actions">
            <x-button-link href="{{route('moderator.rooms.create')}}">
                {{ __('Add a room to be used in this conference') }}
            </x-button-link>
        </x-slot>
    @endcan
    <x-slot name="content">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Company/Institution
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Role
                </th>

            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            <!-- Example User Rows -->
            @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$user->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->email}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->company ? $user->company->name : $user->institution}}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{$user->mainRoles()->implode(', ')}}</td>
                </tr>
            @endforeach
            <!-- Add more user rows as needed -->
            </tbody>
        </table>
    </x-slot>
</x-list-section>

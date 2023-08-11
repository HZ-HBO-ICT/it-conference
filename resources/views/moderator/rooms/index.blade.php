<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Rooms that can be used during the conference
            </h2>
            <a href="{{route('rooms.create')}}"
               class="text-center bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                Add a new room
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
            <table class="table-auto w-full ">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left bg-indigo-500 text-white rounded rounded-r-none">Room name</th>
                    <th class="px-4 py-2 text-left bg-indigo-500 text-white rounded rounded-r-none">Max capacity</th>
                    <th class="px-4 py-2 text-left bg-indigo-500 text-white rounded rounded-r-none">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $index => $room)
                    <tr class="{{ $index % 2 === 0 ? 'dark:bg-gray-900 bg-gray-100' : 'dark:bg-gray-700 bg-gray-200' }} dark:text-gray-200">
                        <td class="px-4 py-5 rounded rounded-t-none text-lg rounded-r-none">
                            {{$room->name}}
                        </td>
                        <td class="px-4 py-5 rounded rounded-t-none text-lg rounded-r-none">
                            {{$room->max_participants}} participants
                        </td>
                        <td class="px-4 py-5 rounded rounded-t-none text-lg rounded-r-none">
                            <div class="flex">
                                <a href="{{route('rooms.edit', $room)}}"
                                    class="text-center bg-indigo-500 hover:bg-indigo-700 text-white px-4 text-xs pt-2 uppercase rounded">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('rooms.destroy', $room) }}" class="pl-2">
                                    @csrf
                                    @method('DELETE')
                                    <x-button
                                        class="dark:bg-red-500 bg-red-500 hover:bg-red-600 hover:dark:bg-red-600 active:bg-red-600 active:dark:bg-red-600">
                                        Delete
                                    </x-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>

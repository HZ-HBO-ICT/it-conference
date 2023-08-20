<x-content-moderator-layout>
    <div id="breadcrumbs">
        <p class="text-gray-800 dark:text-gray-200"><span class="hover:text-violet-500"><a
                    href="{{route('moderator.schedule.overview')}}">Schedule management</a></span> /
            <span>Available rooms</span></p>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white py-5">Room available</h1>

    <a href="{{route('rooms.create')}}"
       class="text-center bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
        Add a new room
    </a>
    <div class="pr-7 py-5">
        <table class="table-auto w-full">
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
</x-content-moderator-layout>

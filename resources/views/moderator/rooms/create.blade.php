<x-hub-layout>
    <div id="breadcrumbs">
        <p class="text-gray-800 dark:text-gray-200"><span class="hover:text-violet-500"><a
                    href="{{route('moderator.schedule.overview')}}">Schedule management</a></span> /
            <span class="hover:text-violet-500"><a
                    href="{{route('moderator.rooms.index')}}">Available rooms</a></span> / Add new room</p>
    </div>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white py-5">Add new room</h1>

    <div class="pr-5">
        <form method="POST" action="{{route('moderator.rooms.store')}}">
            @csrf
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="Room name"/>
                <x-input id="name" name="name" type="text" value="{{old('name')}}" class="mt-1 block w-full"/>
                <x-input-error for="name" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4 py-4">
                <x-label for="max_participants" value="Maximum capacity of the room"/>
                <x-input id="name" name="max_participants" type="number" value="{{old('max_participants')}}"
                         class="mt-1 block w-full"/>
                <x-input-error for="max_participants" class="mt-2"/>
            </div>
            <x-button
                class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                Save
            </x-button>
        </form>
    </div>
</x-hub-layout>

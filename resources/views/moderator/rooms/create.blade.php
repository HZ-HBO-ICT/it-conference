<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Add a new room
            </h2>
        </x-slot>

        <div>
            <form method="POST" action="{{route('rooms.store')}}">
                @csrf
                <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="name" value="Room name"/>
                        <x-input id="name" name="name" type="text" value="{{old('name')}}" class="mt-1 block w-full"/>
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 py-4">
                        <x-label for="max_participants" value="Maximum capacity of the room"/>
                        <x-input id="name" name="max_participants" type="number" value="{{old('max_participants')}}" class="mt-1 block w-full"/>
                        <x-input-error for="max_participants" class="mt-2"/>
                    </div>
                    <x-button
                        class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                        Save
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

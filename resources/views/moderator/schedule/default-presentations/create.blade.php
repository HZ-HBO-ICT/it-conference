<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h1 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            Add {{$event}} for the conference
        </h1>
        <div class="pt-5">
            <div
                class="mt-5 gap-6 text-gray-900 dark:text-gray-200 px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-md">
                <div class="pt-1 p-2">
                    <div class="pr-5">
                        <form method="POST"
                              action="{{route($event == 'opening' ? 'moderator.schedule.store.opening' : 'moderator.schedule.store.closing')}}">
                            @csrf
                            <p class="text-md text-gray-900 dark:text-white">
                                @if($event == 'opening')
                                    Create the opening presentation, give more details about the event that will be
                                    kicking off the conference day.
                                @elseif($event == 'closing')
                                    Create the closing presentation, give more details about the event that will end the
                                    conference day on a high note.
                                @endif
                            </p>
                            <div class="col-span-6 sm:col-span-4 pt-5">
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="name" value="Title" class="after:content-['*'] after:text-red-500"/>
                                    <x-input id="name" name="name" value="{{old('name')}}" type="text"
                                             class="mt-1 block w-full focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600"/>
                                    <x-input-error for="name" class="mt-2"/>
                                </div>
                                <div class="col-span-6 sm:col-span-4 py-4">
                                    <x-label for="description" value="Description"
                                             class="after:content-['*'] after:text-red-500"/>
                                    <textarea name="description"
                                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600 rounded-md shadow-sm block mt-1 w-full">{{old('description')}}</textarea>
                                    <x-input-error for="description" class="mt-2"/>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="starting" value="Starting time"
                                             class="after:content-['*'] after:text-red-500"/>
                                    <x-input id="starting" name="starting" type="time" value="{{old('starting')}}"
                                             class="mt-1 block w-full focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600"/>
                                    <x-input-error for="starting" class="mt-2"/>
                                </div>
                                <div class="col-span-6 sm:col-span-4 py-4">
                                    <x-label for="ending" value="Ending time"
                                             class="after:content-['*'] after:text-red-500"/>
                                    <x-input id="ending" name="ending" type="time" value="{{old('ending')}}"
                                             class="mt-1 block w-full focus:border-crew-500 dark:focus:border-crew-600 focus:ring-crew-500 dark:focus:ring-crew-600"/>
                                    <x-input-error for="ending" class="mt-2"/>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="room_id" value="Room"
                                             class="after:content-['*'] after:text-red-500"/>
                                    <select name="room_id" id="room"
                                            class="mt-1 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-crew-500 focus:border-crew-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-crew-500 dark:focus:border-crew-500">
                                        @foreach (\App\Models\Room::all() as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-button
                                        class="mt-5 dark:bg-crew-500 bg-crew-500 hover:bg-crew-600 hover:dark:bg-crew-600 active:bg-green-600 active:dark:bg-green-600">
                                        @if($event == 'opening')
                                            Next
                                        @else
                                            Create
                                        @endif
                                    </x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>

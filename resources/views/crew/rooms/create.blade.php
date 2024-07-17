<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add a new room') }}
        </h2>
        <div class="pt-5">
            <form method="POST" action="{{route('moderator.rooms.store')}}">
                @csrf
                <x-action-section>
                    <x-slot name="title">
                        {{ __('Room Information') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('The new room basic information.') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="pr-5">
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="name" value="Room name"></x-label>
                                <x-input id="name" name="name" type="text" maxlength="255" value="{{ old('name') }}"
                                         class="mt-1 block w-full"
                                ></x-input>
                                <x-input-error for="name" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 py-4">
                                <x-label for="max_participants" value="Maximum capacity of the room"></x-label>
                                <x-input id="name" name="max_participants" type="number"
                                         value="{{ old('max_participants') }}" min="1" max="999"
                                         class="mt-1 block w-full"></x-input>
                                <x-input-error for="max_participants" class="mt-2"></x-input-error>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="actions">
                        <x-button
                            type="submit"
                            class="dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                            Save
                        </x-button>
                    </x-slot>
            </form>

            </x-action-section>
        </div>
    </div>
</x-hub-layout>

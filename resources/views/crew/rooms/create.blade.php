<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Create a new room') }}
        </h2>
    </div>
    <div class="py-5">
        <form method="POST" action="{{route('moderator.rooms.store')}}">
            @csrf
            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Room Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('The new room basic information.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="pr-5">
                        <div class="col-span-6 sm:col-span-4">
                            <x-waitt.label for="name" value="Room name"></x-waitt.label>
                            <x-waitt.input id="name" name="name" type="text" maxlength="255" value="{{ old('name') }}"
                                     class="mt-1 block w-full"
                            ></x-waitt.input>
                            <x-input-error for="name" class="mt-2"></x-input-error>
                        </div>
                        <div class="col-span-6 sm:col-span-4 py-4">
                            <x-waitt.label for="max_participants" value="Maximum capacity of the room"></x-waitt.label>
                            <x-waitt.input id="name" name="max_participants" type="number"
                                     value="{{ old('max_participants') }}" min="1" max="999"
                                     class="mt-1 block w-full"></x-waitt.input>
                            <x-input-error for="max_participants" class="mt-2"></x-input-error>
                        </div>
                    </div>
                </x-slot>
                <x-slot name="actions">
                    <x-waitt.button
                        type="submit"
                        variant="save"
                        >
                        Save
                    </x-waitt.button>
                </x-slot>
            </x-waitt.action-section>
        </form>
    </div>
</x-crew-colorful-layout>

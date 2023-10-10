<x-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Company details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The company\'s details and the company representative information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-label value="{{ __('Company representative') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div class="text-gray-900 dark:text-white">{{ $team->owner->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <div class="text-gray-900 dark:text-white">{{$team->name}}</div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="description" value="{{ __('Description') }}" />
            <div class="text-gray-900 dark:text-white">{{$team->description}}</div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}"/>
            <div class="text-gray-900 dark:text-white">{{$team->street}} {{$team->house_number}},<br>{{$team->postcode}}, {{$team->city}}</div>
        </div>
    </x-slot>
</x-form-section>

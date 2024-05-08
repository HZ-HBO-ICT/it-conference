<x-action-section>
    <x-slot name="title">
        {{ __('Company details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The company\'s details and the company representative information.') }}
    </x-slot>

    <x-slot name="content">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-label value="{{ __('Company representative') }}"/>

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $company->representative->profile_photo_url }}"
                     alt="{{ $company->representative->name }}">
                <div class="ml-4 leading-tight">
                    <div class="text-gray-900 dark:text-white">{{ $company->representative->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $company->representative->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 py-2 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}"/>
            <div class="text-gray-900 dark:text-white">{{$company->name}}</div>
        </div>

        <div class="col-span-6 py-2 sm:col-span-4">
            <x-label for="description" value="{{ __('Description') }}"/>
            <div class="text-gray-900 dark:text-white">{{$company->description}}</div>
        </div>

        <div class="col-span-6 py-2 sm:col-span-4">
            <x-label for="description" value="{{ __('Phone number') }}"/>
            <div class="text-gray-900 dark:text-white">{{$company->phone_number}}</div>
        </div>

        <div class="col-span-6 py-2 sm:col-span-4">
            <x-label for="description" value="{{ __('Website') }}"/>
            <div class="text-gray-900 dark:text-white">{{$company->website}}</div>
        </div>

        <div class="col-span-6 py-2 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}"/>
            <div class="text-gray-900 dark:text-white">{{$company->street}} {{$company->house_number}}
                ,<br>{{$company->postcode}}
                , {{$company->city}}</div>
        </div>
    </x-slot>
    @can('editDetails', $company)
        <x-slot name="actions">
            <x-button
                wire:click="$dispatch('openModal', { component: 'company.edit-company-modal', arguments: {company: {{$company}}} })">
                {{ __('Edit details') }}
            </x-button>
        </x-slot>
    @endcan
</x-action-section>

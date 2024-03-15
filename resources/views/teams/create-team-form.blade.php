<x-form-section submit="createTeam">
    <x-slot name="title">
        {{ __('Create a new company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add manually a new company that will join the conference. An email with invitation to join as company rep will be sent on the company representative email you specify bellow') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Company Name') }}"/>
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autofocus/>
            <x-input-error for="name" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="description" value="{{ __('Company Description') }}"/>
            <textarea id="description" wire:model.defer="state.description"
                      class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                      name="description" required
            >{{old('company_description')}}</textarea>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="postcode" value="{{ __('Postcode') }}"/>
            <x-input id="postcode" type="text" class="mt-1 block w-full" wire:model.defer="state.postcode" autofocus/>
            <x-input-error for="postcode" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="house_number" value="{{ __('House Number') }}"/>
            <x-input id="house_number" type="text" class="mt-1 block w-full" wire:model.defer="state.house_number"
                     autofocus/>
            <x-input-error for="house_number" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="street" value="{{ __('Street') }}"/>
            <x-input id="street" type="text" class="mt-1 block w-full" wire:model.defer="state.street" autofocus/>
            <x-input-error for="street" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="city" value="{{ __('City') }}"/>
            <x-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="state.city" autofocus/>
            <x-input-error for="city" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="website" value="{{ __('Website') }}"/>
            <x-input id="website" type="text" class="mt-1 block w-full" wire:model.defer="state.website" autofocus/>
            <x-input-error for="website" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-section-border/>
            <x-label for="rep_name" value="{{ __('Company Representative Name') }}"/>
            <x-input id="rep_name" type="text" class="mt-1 block w-full" wire:model.defer="state.rep_name" autofocus/>
            <x-input-error for="rep_name" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="rep_email" value="{{ __('Company Representative Email') }}"/>
            <x-input id="rep_email" type="email" class="mt-1 block w-full" wire:model.defer="state.rep_email"
                     autofocus/>
            <x-input-error for="rep_email" class="mt-2"/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ __('Create') }}
        </x-button>
    </x-slot>
</x-form-section>

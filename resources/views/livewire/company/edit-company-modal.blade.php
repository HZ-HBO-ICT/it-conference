<x-livewire-modal form-action="save">
    <x-slot name="title" class="bg-waitt-dark border-gray-600">
        <h3 class="text-lg leading-6 font-medium text-white">
            Edit company
        </h3>
    </x-slot>

    <x-slot name="description" class="bg-waitt-dark">
        <p class="text-gray-300 text-sm">{{ __('Here you can edit the company details.') }}</p>
    </x-slot>

    <x-slot name="content" class="w-full bg-waitt-dark">
        <div class="px-4 py-6 sm:px-0">
            <dl class="sm:grid sm:grid-cols-3 sm:gap-6">
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="name">{{ __('Company Name') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <input id="name" type="text" 
                           class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                           wire:model="form.name" autofocus>
                    @error('form.name') 
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> 
                    @enderror
                </dd>
                
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="description">{{ __('Company Description') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <textarea id="description" wire:model="form.description"
                              class="h-20 px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent resize-none"
                              name="description" required></textarea>
                    @error('form.description') 
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> 
                    @enderror
                </dd>
                
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="phone_number">{{ __('Company Phone number') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <input id="phone_number" type="tel" 
                           class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                           wire:model="form.phone_number">
                    @error('form.phone_number') 
                        <p class="mt-2 text-sm text-red-400">Invalid phone number</p> 
                    @enderror
                </dd>
                
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="postcode">{{ __('Company Postcode') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <input id="postcode" type="text" 
                           class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                           wire:model="form.postcode">
                    @error('form.postcode') 
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> 
                    @enderror
                </dd>
                
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="house_number">{{ __('House Number') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <input id="house_number" type="text" 
                           class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                           wire:model="form.house_number">
                    @error('form.house_number') 
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> 
                    @enderror
                </dd>
                
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="street">{{ __('Street') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <input id="street" type="text" 
                           class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                           wire:model="form.street">
                    @error('form.street') 
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> 
                    @enderror
                </dd>
                
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="city">{{ __('City') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <input id="city" type="text" 
                           class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                           wire:model="form.city">
                    @error('form.city') 
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> 
                    @enderror
                </dd>
                
                <dt class="text-sm font-medium leading-6 text-white">
                    <label for="website">{{ __('Website') }}</label>
                </dt>
                <dd class="sm:col-span-2">
                    <input id="website" type="url" 
                           class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-waitt-pink-500 focus:border-transparent"
                           wire:model="form.website">
                    @error('form.website') 
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> 
                    @enderror
                </dd>
            </dl>
        </div>
    </x-slot>

    <x-slot name="buttons" class="bg-waitt-dark">
        <button type="button" wire:click="$dispatch('closeModal')" 
                class="mr-3 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-bold rounded-lg shadow transition">
            {{ __('Cancel') }}
        </button>
        <button type="submit"
                class="px-4 py-2 bg-waitt-pink-500 hover:bg-waitt-pink-600 text-white font-bold rounded-lg shadow transition">
            Save
        </button>
    </x-slot>
</x-livewire-modal>

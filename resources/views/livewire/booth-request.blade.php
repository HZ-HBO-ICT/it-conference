<div class="mt-10 sm:mt-0">
    <x-form-section submit="requestBooth">
        <x-slot name="title">
            Booth request
        </x-slot>

        <x-slot name="description">
            Signing up for our company market will after confirmation grant a standard 8m2 (sponsor package size may
            differ) sized area where we will present you with a round standing table. Electricity is available. You can
            bring your own banner to place in the area. Floorplans with location will be provided no later than two
            weeks before the start of the conference. We will expand making more room but you can see an impression from
            last years floorplan
            <LINK>

        </x-slot>

        <x-slot name="form">
            <div class="col-span-6">
                <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    Any additional supplies or preferences you need to fill the area please let us know so we can try to
                    think with you and accommodate you as best as we can.
                </div>
            </div>

            <!-- Additional data -->
            <div class="col-span-6 sm:col-span-4">
                @if(!$this->requestSent)
                    <x-label for="additional_information" value="{{ __('Additional information') }}"/>
                    <textarea wire:model="additionalInformation"
                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"></textarea>
                    <x-input-error for="email" class="mt-2"/>
                @else
                    @if($this->team->booth->is_approved)
                        <div class="row">
                            <div class="mt-4 text-green-600 dark:text-green-400 py-2 text-left rounded">
                                The booth for your company is approved! If you have any questions or concerns do not hesitate to contact us!
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="mt-4 text-amber-500 dark:text-amber-400 py-2 text-left rounded">
                                The request for the booth of your company is still in review and not yet approved.
                            </div>
                        </div>
                    @endif
                @endif
                @if (session()->has('success'))
                    <div class="row">
                        <div class="mt-4 text-green-600 dark:text-green-400 py-2 text-left rounded">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            @if(!$this->requestSent)
                <x-button class="bg-purple-600 dark:bg-purple-500 hover:bg-purple-500 dark:hover:bg-purple-600 text-gray-200 dark:text-gray-200">
                    {{ __('Send request') }}
                </x-button>
            @endif
        </x-slot>
    </x-form-section>
</div>

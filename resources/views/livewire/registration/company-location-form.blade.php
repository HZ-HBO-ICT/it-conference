<div>
    <div class="text-center md:text-left text-gray-100 w-full pb-5">
        <h2 class="text-3xl pt-5 font-semibold">Register</h2>
        <h3 class="text-2xl">Company Address details</h3>
    </div>
    <div id="participant">
        <form wire:submit="goNext">
            @csrf
            <div>
                <div class="mt-3">
                    <x-waitt.label for="company_postcode" value="{{ __('Postcode') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="company_postcode" class="block mt-1 w-full" type="text" name="name" wire:model="companyPostcode"
                             :value="old('company_postcode')"
                             required
                             autofocus autocomplete="postcode"/>
                    <div class="text-red-500 mt-1">@error('companyPostcode') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="company_postcode" value="{{ __('House Number') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="company_house_number" class="block mt-1 w-full" type="text" name="name" wire:model="companyHouseNumber"
                             :value="old('company_house_number')"
                             required
                             autofocus/>
                    <div class="text-red-500 mt-1">@error('companyHouseNumber') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="company_street" value="{{ __('Street') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="company_street" class="block mt-1 w-full" type="text" name="name" wire:model="companyStreet"
                             :value="old('company_street')"
                             required
                             autofocus autocomplete="street"/>
                    <div class="text-red-500 mt-1">@error('companyStreet') {{ $message }} @enderror</div>
                </div>

                <div class="mt-4">
                    <x-waitt.label for="company_city" value="{{ __('City') }}"
                             class="after:content-['*'] after:text-red-500"/>
                    <x-waitt.input id="company_city" class="block mt-1 w-full" type="text" name="company_city" wire:model="companyCity"
                             :value="old('company_city')"
                             required
                             autofocus autocomplete="city"/>
                    <div class="text-red-500 mt-1">@error('companyCity') {{ $message }} @enderror</div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-waitt.checkbox name="terms" id="terms" wire:model='terms' required/>
                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms-and-conditions').'" class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('privacy-policy').'" class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-between mt-4">
                    <!-- Go back button on the left -->
                    <x-waitt.button type="button" wire:click="goBack" class="mr-4">
                        {{ __('Go back') }}
                    </x-waitt.button>

                    <!-- Existing content -->
                    <div class="flex items-center justify-end">
                        <x-waitt.button type="submit" class="ml-4">
                            {{ __('Register') }}
                        </x-waitt.button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

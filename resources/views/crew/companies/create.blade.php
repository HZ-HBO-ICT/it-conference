@php use App\Models\User @endphp
<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Create a company') }}
        </h2>
    </div>
    <div class="py-5">
        <form method="POST" action="{{route('moderator.companies.store')}}">
            @csrf
            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Company details') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Add manually a new company that will join the conference that will be owned by the user with the specified email adress') }}
                </x-slot>

                <x-slot name="content">
                    <div class="pr-5">

                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="name" value="{{ __('Company Name') }}"
                                     class="after:content-['*'] after:text-red-500"></x-waitt.label>
                            <x-waitt.input name="name" type="text" class="mt-1 block w-full"
                                     value="{{ old('name') }}" autofocus></x-waitt.input>
                            <x-input-error for="name" class="mt-2"></x-input-error>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="description" value="{{ __('Company Description') }}"></x-waitt.label>
                            <x-waitt.input-textarea name="description"
                                      class="after:content-['*'] after:text-red-500 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs block mt-1 w-full"
                                      name="description"
                            >{{old('description')}}</x-waitt.input-textarea>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="phone_number" value="{{ __('Phone number') }}"
                                     class="after:content-['(optional)'] after:text-gray-500 after:text-sm"></x-waitt.label>
                            <x-waitt.input name="phone_number" type="tel" class="mt-1 block w-full"
                                     value="{{ old('phone_number') }}"></x-waitt.input>
                            @if ($errors->has('phone_number'))
                                <span class="text-red-500 text-sm mt-2">Invalid phone number</span>
                            @endif
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label class="after:content-['*'] after:text-red-500" for="postcode"
                                     value="{{ __('Postcode') }}"></x-waitt.label>
                            <x-waitt.input name="postcode" type="text" class="mt-1 block w-full"
                                     value="{{ old('postcode') }}"></x-waitt.input>
                            <x-input-error for="postcode" class="mt-2"></x-input-error>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label class="after:content-['*'] after:text-red-500" for="house_number"
                                     value="{{ __('House Number') }}"></x-waitt.label>
                            <x-waitt.input name="house_number" type="text" class="mt-1 block w-full"
                                     value="{{ old('house_number') }}"></x-waitt.input>
                            <x-input-error for="house_number" class="mt-2"></x-input-error>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label class="after:content-['*'] after:text-red-500" for="street"
                                     value="{{ __('Street') }}"></x-waitt.label>
                            <x-waitt.input name="street" type="text" class="mt-1 block w-full"
                                     value="{{ old('street') }}"></x-waitt.input>
                            <x-input-error for="street" class="mt-2"></x-input-error>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label class="after:content-['*'] after:text-red-500" for="city"
                                     value="{{ __('City') }}"></x-waitt.label>
                            <x-waitt.input name="city" type="text" class="mt-1 block w-full"
                                     value="{{ old('city') }}"></x-waitt.input>
                            <x-input-error for="city" class="mt-2"></x-input-error>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label class="after:content-['*'] after:text-red-500" for="website"
                                     value="{{ __('Website') }}"></x-waitt.label>
                            <div class="flex">
                                    <span class="flex items-center border px-3 border-gray-700 bg-gray-900 text-gray-300
                                    rounded-md shadow-sm mt-1 border-r-0 rounded-r-none">https://</span>
                                <x-waitt.input id="website" class="block mt-1 w-full rounded-l-none"
                                         placeholder="www.example.com" type="text" name="website"
                                         required value="{{ old('website') }}"
                                />
                            </div>
                            <x-input-error for="website" class="mt-2"></x-input-error>
                        </div>
                        <x-section-border/>
                        <div class="col-span-6 sm:col-span-4">
                            <x-waitt.label class="after:content-['*'] after:text-red-500" for="rep_email"
                                     value="{{ __('Company Representative') }}"></x-waitt.label>
                            <div class="py-2">
                                <span class="text-sm text-gray-300 pt-3 pb-1">If they <b>have registered</b> already: </span>
                                <x-select name="rep_email" class="mt-1 block w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs">
                                    <option selected>Select user...</option>
                                    @foreach(User::forCompanyRep()->get() as $user)
                                        <option value="{{ $user->email }}">
                                            {{ $user->name }} | {{ $user->email }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <span class="text-sm text-gray-300 pt-3 pb-1">or if they <b>do not have an account</b> yet:</span>
                                <x-waitt.input name="rep_new_email" type="email" class="mt-1 block w-full"
                                         value="{{ old('rep_new_email') }}"
                                         placeholder="john.doe@example.com"></x-waitt.input>
                                <x-input-error for="rep_new_email" class="mt-2"></x-input-error>
                            </div>
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

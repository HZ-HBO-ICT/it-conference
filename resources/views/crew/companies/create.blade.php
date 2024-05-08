@php use App\Models\User @endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a company') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Company details') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Add manually a new company that will join the conference that will be owned by the user with the specified email adress') }}
                </x-slot>

                <x-slot name="content">
                    <div class="pr-5">
                        <form method="POST" action="{{route('moderator.companies.store')}}">
                            @csrf
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="name" value="{{ __('Company Name') }}"></x-label>
                                <x-input name="name" type="text" class="mt-1 block w-full"
                                         value="{{ old('name') }}" autofocus></x-input>
                                <x-input-error for="name" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="description" value="{{ __('Company Description') }}"></x-label>
                                <textarea name="description"
                                          class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full"
                                          name="description"
                                >{{old('description')}}</textarea>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="phone_number" value="{{ __('Phone number') }}"></x-label>
                                <x-input name="phone_number" type="tel" class="mt-1 block w-full"
                                         value="{{ old('phone_number') }}"></x-input>
                                <x-input-error for="phone_number" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="postcode" value="{{ __('Postcode') }}"></x-label>
                                <x-input name="postcode" type="text" class="mt-1 block w-full"
                                         value="{{ old('postcode') }}"></x-input>
                                <x-input-error for="postcode" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="house_number" value="{{ __('House Number') }}"></x-label>
                                <x-input name="house_number" type="text" class="mt-1 block w-full"
                                         value="{{ old('house_number') }}"></x-input>
                                <x-input-error for="house_number" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="street" value="{{ __('Street') }}"></x-label>
                                <x-input name="street" type="text" class="mt-1 block w-full"
                                         value="{{ old('street') }}"></x-input>
                                <x-input-error for="street" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="city" value="{{ __('City') }}"></x-label>
                                <x-input name="city" type="text" class="mt-1 block w-full"
                                         value="{{ old('city') }}"></x-input>
                                <x-input-error for="city" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="website" value="{{ __('Website') }}"></x-label>
                                <div class="flex">
                                    <span class="flex items-center text-gray-500 border-gray-300 border px-3 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                    rounded-md shadow-sm block mt-1 border-r-0 rounded-r-none">https://</span>
                                    <x-input id="website" class="block mt-1 w-full rounded-l-none"
                                             placeholder="www.example.com" type="text" name="website"
                                             required
                                    />
                                </div>
                                <x-input-error for="website" class="mt-2"></x-input-error>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="rep_email" value="{{ __('Company Representative') }}"></x-label>
                                <x-select name="rep_email" class="mt-1 block w-full">
                                    @foreach(User::forCompanyRep()->get() as $user)
                                        <option value="{{ $user->email }}">
                                            {{ $user->name }} | {{ $user->email }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <span class="text-sm text-gray-600 py-1">or if they do not have an account yet</span>
                                <x-input name="rep_new_email" type="email" class="mt-1 block w-full"
                                         value="{{ old('rep_new_email') }}"></x-input>
                                <x-input-error for="rep_new_email" class="mt-2"></x-input-error>
                            </div>
                            <x-button
                                class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                                Save
                            </x-button>

                        </form>
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>

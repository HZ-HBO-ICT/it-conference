<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invite a new user') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
                <x-slot name="title">
                    {{ __('User details') }}
                </x-slot>

                <x-slot name="description">
                    <div class="text-sm text-gray-600 dark:text-gray-200">
                        <p>{{ __('Add manually a new company that will join the conference.') }}</p>
                        <p>{{__(' NOTE: the user will be added as participant by default')}}</p>
                        <p class="pt-3">If you want the user to be a speaker, after inviting them, you can add
                                        the presentation. If you want them to be a company representative, you can add
                                        them directly from here, without creating them from here.</p>
                    </div>
                </x-slot>

                <x-slot name="content">
                    <div class="pr-5">
                        <form method="POST" action="{{route('moderator.users.store')}}">
                            @csrf
                            <div class="col-span-6 sm:col-span-4 py-2">
                                <x-label for="name" value="{{ __('Full Name') }}"/>
                                <x-input id="name" value="{{old('name')}}" name="name" type="text" class="mt-1 block w-full" autofocus/>
                                <x-input-error for="name" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="email" value="{{ __('Email') }}"/>
                                <x-input id="email" value="{{old('email')}}" name="email" type="email" class="mt-1 block w-full" autofocus/>
                                <x-input-error for="email" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 py-2">
                                <x-label for="institution" value="{{ __('Institution') }}"/>
                                <x-input id="institution" value="{{old('institutiong')}}" name="institution" type="text" class="mt-1 block w-full" autofocus/>
                                <x-input-error for="institution" class="mt-2"/>
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

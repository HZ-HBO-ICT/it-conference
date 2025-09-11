@php use App\Models\Difficulty; @endphp
<x-crew-colorful-layout>
    <div class="flex items-center justify-between mt-5">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Create a presentation') }}
        </h2>
    </div>
    <div class="py-5">
        <form method="POST" action="{{route('moderator.presentations.store')}}">
            @csrf
            <x-waitt.action-section>
                <x-slot name="title">
                    {{ __('Presentation details') }}
                </x-slot>
                <x-slot name="description">
                    <div class="text-sm text-gray-600 dark:text-gray-200">
                        <p>{{ __('Add manually add a new presentation that will be hosted during the conference.') }}</p>
                    </div>
                </x-slot>
                <x-slot name="content">
                    <div class="pr-5">
                        <div class="col-span-6 sm:col-span-4">
                            <x-waitt.label for="name" value="Title" class="after:content-['*'] after:text-red-500"/>
                            <x-waitt.input id="name" name="name" value="{{old('name')}}" type="text" maxlength="255"
                                           class="mt-1 block w-full"/>
                            <x-input-error for="name" class="mt-2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4 py-4">
                            <x-waitt.label for="description" value="Description"
                                           class="after:content-['*'] after:text-red-500"/>
                            <x-waitt.input-textarea name="description" maxlength="300"
                                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs block mt-1 w-full">{{old('description')}}
                            </x-waitt.input-textarea>
                            <x-input-error for="description" class="mt-2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="presentation_type_id" value="Type of presentation"
                                           class="after:content-['*'] after:text-red-500"/>
                            <select name="presentation_type_id"
                                    class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block">
                                @foreach($presentationTypes as $presentationType)
                                    @php
                                        $selected = old('presentation_type_id', 1) == $presentationType->id ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $presentationType->id }}" {{ $selected }}>
                                        {{ $presentationType->name }} ({{ $presentationType->duration }} minutes)
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error for="presentation_type_id" class="mt-2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4 pb-4">
                            <x-waitt.label for="difficulty_id" value="Difficulty of the presentation"
                                           class="after:content-['*'] after:text-red-500"/>
                            <select name="difficulty_id"
                                    class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block">
                                @foreach(Difficulty::all() as $difficulty)
                                    <option
                                        {{old('difficulty_id') == $difficulty->id ? 'selected' : ''}} value="{{$difficulty->id}}">{{ucfirst($difficulty->level)}}</option>
                                @endforeach
                            </select>
                            <x-input-error for="difficulty_id" class="mt-2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-waitt.label for="max_participants" value="Preferred number of maximum participants"
                                           class="after:content-['*'] after:text-red-500"/>
                            <x-waitt.input id="max_participants" name="max_participants" type="number"
                                           value="{{old('max_participants')}}" class="mt-1 block w-full"/>
                            <x-input-error for="max_participants" class="mt-2"/>
                        </div>
                        <x-waitt.section-border/>
                        <div class="col-span-6 sm:col-span-4">
                            <x-waitt.label for="user_id" class="after:content-['*'] after:text-red-500"
                                           value="{{ __('Main Speaker') }}"></x-waitt.label>
                            <select name="user_id"
                                    class="w-full border-gray-700 bg-gray-900 text-gray-300 focus:border-teal-600 focus:ring-teal-600 rounded-md shadow-xs mt-1 block">>
                                @foreach($users as $user)
                                    @if(!$user->hasRole('crew'))
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }} | {{ $user->email }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error for="user_id" class="mt-2"></x-input-error>
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

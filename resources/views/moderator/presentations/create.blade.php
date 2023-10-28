@php use App\Models\Difficulty; @endphp
<x-hub-layout>
    <div class="py-8 px-8 mx-auto max-w-7xl">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new presentation') }}
        </h2>
        <div class="pt-5">
            <x-action-section>
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
                        <form method="POST" action="{{route('moderator.presentations.store')}}">
                            @csrf
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="name" value="Title" class="after:content-['*'] after:text-red-500"/>
                                <x-input id="name" name="name" value="{{old('name')}}" type="text"
                                         class="mt-1 block w-full"/>
                                <x-input-error for="name" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 py-4">
                                <x-label for="description" value="Description"
                                         class="after:content-['*'] after:text-red-500"/>
                                <textarea name="description"
                                          class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">{{old('description')}}
                                    </textarea>
                                <x-input-error for="description" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="type" value="Type of presentation"
                                         class="after:content-['*'] after:text-red-500"/>
                                <select name="type"
                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                    <option {{old('type') == 'lecture' ? 'selected' : ''}} value="lecture">Lecture
                                                                                                           (30
                                                                                                           minutes)
                                    </option>
                                    <option {{old('type') == 'workshop' ? 'selected' : ''}} value="workshop">
                                        Workshop (90 minutes)
                                    </option>
                                </select>
                                <x-input-error for="workshop" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4 pb-4">
                                <x-label for="difficulty_id" value="Difficulty of the presentation"
                                         class="after:content-['*'] after:text-red-500"/>
                                <select name="difficulty_id"
                                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                    @foreach(Difficulty::all() as $difficulty)
                                        <option
                                            {{old('difficulty_id') == $difficulty->id ? 'selected' : ''}} value="{{$difficulty->id}}">{{ucfirst($difficulty->level)}}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="difficulty_id" class="mt-2"/>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="max_participants" value="Preferred number of maximum participants"
                                         class="after:content-['*'] after:text-red-500"/>
                                <x-input id="max_participants" name="max_participants" type="number"
                                         value="{{old('max_participants')}}" class="mt-1 block w-full"/>
                                <x-input-error for="max_participants" class="mt-2"/>
                            </div>
                            <x-section-border/>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="user_id" class="after:content-['*'] after:text-red-500" value="{{ __('Main Speaker') }}"></x-label>
                                <x-select name="user_id" class="mt-1 block w-full">
                                    @foreach($users as $user)
                                        @if(!$user->hasRole('company representative') && !$user->hasRole('content moderator'))
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} | {{ $user->email }}
                                            </option>
                                        @endif
                                    @endforeach
                                </x-select>
                                <x-input-error for="user_id" class="mt-2"></x-input-error>
                            </div>
                            <x-button
                                class="mt-5 dark:bg-purple-500 bg-purple-500 hover:bg-purple-600 hover:dark:bg-purple-600 active:bg-purple-600 active:dark:bg-purple-600">
                                Submit
                            </x-button>
                        </form>
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    </div>
</x-hub-layout>

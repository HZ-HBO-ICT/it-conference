@php use App\Models\Difficulty; @endphp
<x-hub-layout>
    <div class="pt-8 mx-auto max-w-7xl">
        <div class="px-8">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Request presentation
            </h2>
            <h2 class="text-md text-gray-800 dark:text-gray-200 pt-2">
                If you would like to host a lecture or a workshop during the IT Conference please fill out the form
                below, and we will get in touch with you
            </h2>
        </div>
        <div>
            <form method="POST" action="{{route('presentations.store')}}">
                @csrf
                <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded-sm">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="name" value="Title" class="after:content-['*'] after:text-red-500"/>
                        <x-input id="name" name="name" maxlength="255" value="{{old('name')}}" type="text" class="mt-1 block w-full"/>
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 py-4">
                        <x-label for="description" value="Description" class="after:content-['*'] after:text-red-500"/>
                        <textarea name="description" maxlength="300"
                                  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xs block mt-1 w-full">{{old('description')}}</textarea>
                        <x-input-error for="description" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-4">
                        <x-label for="presentation_type_id" value="Type of presentation" class="after:content-['*'] after:text-red-500"/>
                        <select name="presentation_type_id"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @foreach($presentationTypes as $presentationType)

                                <option value="{{ $presentationType->id }}" {{ old('presentation_type_id', 1) == $presentationType->id ? 'selected' : '' }}>
                                    {{ $presentationType->name }} ({{ $presentationType->duration }} minutes)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="presentation_type_id" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-4">
                        <x-label for="difficulty_id" value="Difficulty of the presentation" class="after:content-['*'] after:text-red-500"/>
                        <select name="difficulty_id"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @foreach(Difficulty::all() as $difficulty)
                                <option {{old('difficulty_id') == $difficulty->id ? 'selected' : ''}} value="{{$difficulty->id}}">{{ucfirst($difficulty->level)}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="difficulty_id" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="max_participants" value="Preferred number of maximum participants" class="after:content-['*'] after:text-red-500"/>
                        <x-input id="max_participants" name="max_participants" type="number" value="{{old('max_participants')}}" class="mt-1 block w-full"/>
                        <x-input-error for="max_participants" class="mt-2"/>

                    </div>
                    <x-button
                        class="mt-5 dark:bg-purple-500 bg-purple-500 hover:bg-purple-600 dark:hover:bg-purple-600 active:bg-purple-600 dark:active:bg-purple-600">
                        Submit
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-hub-layout>

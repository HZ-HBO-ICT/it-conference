@php use App\Models\Difficulty; @endphp
<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit presentation
            </h2>
        </x-slot>

        <div>
            <form method="POST" action="{{route('presentations.update', $presentation)}}">
                @method('PUT')
                @csrf
                <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="name" value="Title"/>
                        <x-input id="name" name="name" type="text" class="mt-1 block w-full"
                                 value="{{$presentation->name}}"/>
                        <x-input-error for="name" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 py-4">
                        <x-label for="description" value="Description"/>
                        <textarea name="description"
                                  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">{{$presentation->description}}
                        </textarea>
                        <x-input-error for="description" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-4">
                        <x-label for="type" value="Type of presentation"/>
                        <select name="type"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            <option value="lecture"
                                {{$presentation->type === 'lecture' ? 'selected' : ''}}>
                                Lecture (30 minutes)
                            </option>
                            <option value="workshop"
                                {{$presentation->type === 'workshop' ? 'selected' : ''}}>
                                Workshop (90 minutes)
                            </option>
                        </select>
                        <x-input-error for="workshop" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4 pb-4">
                        <x-label for="difficulty_id" value="Difficulty of the presentation"/>
                        <select name="difficulty_id"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            @foreach(Difficulty::all() as $difficulty)
                                <option
                                    value="{{$difficulty->id}}" {{$presentation->difficulty->id === $difficulty->id ? 'selected' : ''}}>{{ucfirst($difficulty->level)}}</option>
                            @endforeach
                        </select>
                        <x-input-error for="difficulty_id" class="mt-2"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="max_participants" value="Preferred number of maximum participants"/>
                        <x-input id="max_participants" name="max_participants" type="number" class="mt-1 block w-full"
                                 value="{{$presentation->max_participants}}"/>
                        <x-input-error for="max_participants" class="mt-2"/>
                    </div>
                    <x-button
                        class="mt-5 dark:bg-green-500 bg-green-500 hover:bg-green-600 hover:dark:bg-green-600 active:bg-green-600 active:dark:bg-green-600">
                        Save
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
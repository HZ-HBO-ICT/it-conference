<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Presentations that need to be scheduled
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
            <table class="table-auto w-full ">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left bg-indigo-500 text-white rounded rounded-r-none">Speaker</th>
                    <th class="px-4 py-2 text-left bg-indigo-500 text-white rounded rounded-r-none rounded-l-none">
                        Presentation title
                    </th>
                    <th class="px-4 py-2 text-left bg-indigo-500 text-white rounded rounded-l-none">Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach($presentations as $index => $presentation)
                    <tr class="{{ $index % 2 === 0 ? 'dark:bg-gray-900 bg-gray-100' : 'dark:bg-gray-700 bg-gray-200' }} dark:text-gray-200">
                        <td class="px-4 py-5 rounded rounded-t-none text-lg rounded-r-none">
                            <a href="{{route('moderator.schedule.presentation', $presentation)}}">
                                {{$presentation->mainSpeaker()->user->name}}
                            </a>
                        </td>
                        <td class="px-4 py-5 rounded rounded-t-none text-lg rounded-r-none rounded-l-none">
                            <a href="{{route('moderator.schedule.presentation', $presentation)}}">
                                {{$presentation->name}}
                            </a>
                        </td>
                        <td class="px-4 py-5 rounded rounded-t-none text-lg rounded-l-none">
                            <a href="{{route('moderator.schedule.presentation', $presentation)}}">
                                {{ucfirst($presentation->type)}}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
<style>
    td a {
        display: block;
    }
</style>

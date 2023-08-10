<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Requests for {{$type}}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 mt-12 sm:px-6 lg:px-8 dark:bg-gray-800 bg-gray-200 rounded">
            <table class="table-auto w-full ">
                <thead>
                <tr>
                    <th class="px-4 py-2 text-left bg-indigo-500 text-white rounded rounded-r-none">Company name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $index => $team)
                    <tr class="{{ $index % 2 === 0 ? 'dark:bg-gray-900 bg-gray-100' : 'dark:bg-gray-700 bg-gray-200' }} dark:text-gray-200">
                        <td class="px-4 py-5 rounded rounded-t-none underline text-lg">
                            <a href="{{route('moderator.request.details', ['teams', $team])}}">
                                {{$team->name}}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>

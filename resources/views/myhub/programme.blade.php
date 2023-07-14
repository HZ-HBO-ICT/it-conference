<x-hub-layout>
    {{--personal programme--}}
    <div class="w-full mr-8">
        <div class="bg-white dark:bg-gray-800 h-fit overflow-hidden rounded-lg shadow-xl">
            <div class="px-6 py-6 bg-gray-50 dark:bg-gray-800">
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Programme</h2>

                @if($presentations->isEmpty())
                    <p class="text-l pt-16 text-gray-800 dark:text-gray-200">You need to register to a presentation or workshop first!</p>
                @else
                    <p class="text-l pt-16 text-gray-800 dark:text-gray-200">The lectures/workshops you are registered for:</p>

                    <ul class="list-disc list-inside dark:text-gray-800 mt-8">
                        @foreach($presentations as $presentation)
                            <li>
                                <p class="text-l text-gray-800 dark:text-gray-200">{{ $presentation->timeslot->start }} - {{ $presentation->name }} - {{ $presentation->room->name }}</p>
                            </li>
                        @endforeach
                    </ul>

                    <button type="button"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-16">
                        Edit
                    </button>
                @endif
            </div>
        </div>
    </div>
</x-hub-layout>

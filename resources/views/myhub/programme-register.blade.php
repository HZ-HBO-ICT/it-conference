<x-hub-layout>
    {{--personal programme--}}
    <div class="z-20 w-full mr-8">
        <div class="bg-white dark:bg-gray-800 h-fit overflow-hidden rounded-lg shadow-xl">
            <div class="px-6 py-6 bg-gray-50 dark:bg-gray-800">
                <div class="flex flex-row justify-between">
                    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Programme</h2>
                </div>

                <p class="text-l pt-16 text-gray-800 dark:text-gray-200">Available presentations/workshops:</p>

                <ul class="space-y-2 list-disc list-inside dark:text-gray-800 mt-8 pl-5">
                    @foreach($presentations as $presentation)
                        <li class="flex gap-4">
                            <p class="presentations text-l text-gray-800 dark:text-gray-200">{{ Carbon\Carbon::parse($presentation->timeslot->start)->format('H:i') }} — {{ $presentation->name }} — {{ $presentation->room->name }} — {{ ucfirst($presentation->type) }} — Participants: {{ $presentation->participants->count() }}/{{ $presentation->max_participants }}</p>

                            @if (in_array($presentation->id, $enrolledPresentations))
                                <form action="{{ route('destroy-participant', $presentation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div>
                                        <button type="submit"
                                           class="participation-buttons text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-full text-sm px-5 py-0.5 text-center mr-2 mb-2">Disenroll</button>
                                    </div>
                                </form>
                            @elseif($presentation->participants->count() < $presentation->max_participants && !in_array($presentation->id, $disabledPresentations))
                                <form action="{{ route('create-participant', $presentation->id) }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <div>
                                        <button type="submit"
                                           class="participation-buttons text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-full text-sm px-8 py-0.5 text-center mr-2 mb-2">Enroll</button>
                                    </div>
                                </form>
                            @else
                                <div>
                                    <a type="button" href="#"
                                       class="participation-buttons bg-gray-500 py-0.5 px-8 mr-2 mb-2 text-sm font-medium text-gray-300 rounded-full"
                                       style="pointer-events: none;">Enroll</a>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('my-programme') }}" type="button"
                   class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-16">
                    Go back
                </a>
            </div>
        </div>
    </div>
</x-hub-layout>

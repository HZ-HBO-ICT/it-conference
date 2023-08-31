@php use Carbon\Carbon; @endphp
<x-hub-layout>
    {{--personal programme--}}
    <div class="z-20 w-full mr-8">
        <div class="bg-white dark:bg-gray-800 h-fit overflow-hidden rounded-lg shadow-xl">
            <div class="px-6 py-6 bg-gray-50 dark:bg-gray-800">
                <div class="grid grid-cols-4">
                    <div style="grid-column: span 2">
                        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Programme</h2>
                    </div>
                    <div>
                        <a type="button"
                           href="{{ route('my-programme-register') }}"
                           class="hidden lg:block md:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Register for presentations
                        </a>
                    </div>
                    @can('sendRequest', App\Models\Presentation::class)
                        <div>
                            <a type="button"
                               href="{{ route('speakers.request.presentation') }}"
                               class="hidden lg:block md:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                Do you want to host lecture/workshop?
                            </a>
                        </div>
                    @endcan
                </div>

                @if($presentations->isEmpty())
                    <p class="text-l pt-5 text-gray-800 dark:text-gray-200">You need to register to a presentation or
                                                                            workshop first!</p>
                @else
                    <p class="text-l py-5 text-gray-800 dark:text-gray-200">The lectures/workshops you are registered
                                                                             for:</p>

                    <table class="table-auto w-full text-gray-900 dark:text-gray-200">
                        <thead>
                        <tr class="text-left">
                            <th>Timeframe</th>
                            <th>Presentation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($presentations as $presentation)
                            <tr>
                                <td class="text-left text-gray-900 dark:text-white align-top">
                                    {{Carbon::parse($presentation->timeslot->start)->format('H:i')}}
                                    - {{(Carbon::parse($presentation->timeslot->start)->addMinutes(30))->format('H:i')}}
                                </td>
                                <td class="pb-3">
                                    <x-my-programme-block :presentation="$presentation"/>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-hub-layout>

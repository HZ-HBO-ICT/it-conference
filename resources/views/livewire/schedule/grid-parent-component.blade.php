<div
    class="flex overflow-x-auto overflow-y-hidden py-2.5">
    <div class="flex-none w-58 mr-4 pt-2">
        <div class="mb-4 p-2">
            <h2 class="font-bold text-xl mb-2 text-center">Unscheduled</h2>
            <div class="mb-4 bg-white dark:bg-gray-800 p-3">
                <h3 class="font-bold text-lg mb-2 text-center text-crew-300 p-1 rounded">Lectures</h3>
                <ul class="space-y-1">
                    @if($lectureCount > 0)
                        @foreach ($unscheduledPresentations as $presentation)
                            @if ($presentation->type === 'lecture')
                                <li wire:key="task-{{ $presentation->id }}"
                                    x-data="draggable()"
                                    draggable="true"
                                    @dragstart="dragStart"
                                    data-id="{{ $presentation->id }}"
                                    data-room="0"
                                    class="p-2 h-20 rounded shadow cursor-pointer
                                    {{!optional(App\Models\Edition::current())->is_final_programme_released ? "bg-crew-200 hover:bg-crew-200 dark:bg-crew-400/50 dark:hover:bg-crew-400/70" : "bg-red-400 hover:bg-red-400 dark:bg-red-800/50 dark:hover:bg-red-800/50"}}">
                                    <div class="grid grid-cols-1">
                                    <span class="col-span-1">
                                        {{ $presentation->displayName(20) }}
                                    </span>
                                        <span class="text-xs col-span-1">
                                          {{ strlen($presentation->speakersName) > 29 ? substr($presentation->speakersName, 0, 29) . '...' : $presentation->speakersName }}
                                    </span>
                                        @if($presentation->company)
                                            <span class="text-xs col-span-1">
                                          {{ strlen($presentation->company->name) > 29 ? substr($presentation->company->name, 0, 29) . '...' : $presentation->company->name }}
                                        </span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <div
                            class="p-2 text-center text-sm rounded dark:text-gray-100">
                            All lectures are scheduled.
                        </div>
                    @endif
                </ul>
            </div>

            <div class="mb-4 bg-white dark:bg-gray-800 p-3">
                <h3 class="font-bold text-lg mb-2 text-center text-apricot-peach-400 p-1 rounded">Workshops</h3>
                <ul class="space-y-1 ">
                    @if($workshopCount > 0)
                        @foreach ($unscheduledPresentations as $presentation)
                            @if ($presentation->type === 'workshop')
                                <li wire:key="task-{{ $presentation->id }}"
                                    x-data="draggable()"
                                    draggable="true"
                                    @dragstart="dragStart"
                                    data-id="{{ $presentation->id }}"
                                    data-room="0"
                                    class="p-2 h-20 rounded shadow cursor-pointer
                                    {{!optional(App\Models\Edition::current())->is_final_programme_released ? "bg-apricot-peach-200 hover:bg-apricot-peach-300 dark:bg-apricot-peach-700/50 dark:hover:bg-apricot-peach-600/75" : "bg-red-400 hover:bg-red-400 dark:bg-red-800/50 dark:hover:bg-red-800/50"}}">
                                <div class="grid grid-cols-1">
                                    <span class="col-span-1">
                                        {{ $presentation->displayName(20) }}
                                    </span>
                                        <span class="text-xs col-span-1">
                                          {{ strlen($presentation->speakersName) > 29 ? substr($presentation->speakersName, 0, 29) . '...' : $presentation->speakersName }}
                                    </span>
                                        @if($presentation->company)
                                            <span class="text-xs col-span-1">
                                          {{ strlen($presentation->company->name) > 29 ? substr($presentation->company->name, 0, 29) . '...' : $presentation->company->name }}
                                        </span>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <div
                            class="p-2 text-center text-sm rounded dark:text-gray-100">
                            All workshops are scheduled.
                        </div>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="flex overflow-x-auto w-full py-2.5 shadow-lg overflow-x-auto overflow-y-hidden">
        <table class="h-max min-w-max bg-white rounded">
            <thead class="bg-crew-300">
            <tr>
                <th class="w-32 p-4 text-center text-white border-r rounded-tl-lg border-gray-300 dark:border-gray-900">
                    Time Slot
                </th>
                @foreach ($rooms as $room)
                    <th class="w-64 p-4 text-center text-white border-r border-gray-300 dark:border-gray-900m">{{$room->name}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody id="grid-body">
            <tr class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-gray-100 text-gray-700 dark:text-gray-100 h-max hover:bg-gray-50">
                <td class="text-gray-600 h-full text-center border-r border-gray-300 dark:border-gray-900 flex items-start justify-center">
                    <span class="pt-2">
                        {{\Carbon\Carbon::parse(\App\Models\DefaultPresentation::opening()->start)->format('H:i')}}
                    </span>
                </td>
                <td class="text-left border-r h-full border-gray-300 dark:border-gray-900 relative overflow-visible" colspan="{{\App\Models\Room::all()->count()}}">
                    <livewire:schedule.default-presentation :type="'opening'"/>
                </td>
            </tr>
            @foreach($timeslots as $timeslot)
                @php
                    $time = \Carbon\Carbon::parse($timeslot->start);
                    $isEven = $timeslot->id % 2 == 0;
                @endphp
                <tr class=" {{$isEven ? "border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-gray-100" : "dark:border-gray-700 dark:bg-gray-700"}} text-gray-700 dark:text-gray-100 h-max hover:bg-gray-50">
                    <td class="{{$isEven ? 'text-gray-400' : 'text-gray-600' }} h-max text-center border-r border-gray-300 dark:border-gray-900">{{$time->format('H:i')}}</td>
                    @foreach ($rooms as $room)
                        <td class="text-left border-r h-max border-gray-300 dark:border-gray-900 relative overflow-visible">
                            <livewire:schedule.cell wire:key="cell-r-{{ $room->id }}-t-{{$timeslot->id}}"
                                                    :timeslot="$timeslot" :room="$room"
                            />
                        </td>
                    @endforeach
                </tr>
            @endforeach
            <tr class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-gray-100 text-gray-700 dark:text-gray-100 h-max hover:bg-gray-50">
                <td class="text-gray-600 h-full text-center border-r border-gray-300 dark:border-gray-900 flex items-start justify-center">
                    <span class="pt-2">
                        {{\Carbon\Carbon::parse(\App\Models\DefaultPresentation::closing()->start)->format('H:i')}}
                    </span>
                </td>
                <td class="text-left border-r h-full border-gray-300 dark:border-gray-900 relative overflow-visible" colspan="{{\App\Models\Room::all()->count()}}">
                    <livewire:schedule.default-presentation :type="'closing'"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/draggable.js') }}"></script>

</div>

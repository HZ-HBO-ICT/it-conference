@php use Carbon\Carbon; @endphp
<div
    class="flex overflow-x-auto overflow-y-hidden py-2.5">
    <div class="flex-none w-58 mr-4 pt-2">
        <div class="mb-4">
            <h2 class="font-bold text-white text-xl mb-2 ml-3 text-left">Unscheduled</h2>
            @foreach($presentationTypes as $presentationType)
                <div class="p-3 rounded-xl">
                    <h3 class="font-bold text-lg mb-2 text-left text-{{$presentationType->colour}}-300 p-1 rounded-sm">{{$presentationType->name}}</h3>
                    <ul class="space-y-1">
                        @if($presentationType->unscheduledPresentationCount() > 0)
                            @foreach ($unscheduledPresentations as $presentation)
                                @if ($presentation->presentation_type_id === $presentationType->id)
                                    <li wire:key="task-{{ $presentation->id }}"
                                        x-data="draggable()"
                                        draggable="true"
                                        @dragstart="dragStart"
                                        data-id="{{ $presentation->id }}"
                                        data-room="0"
                                        class="p-2 h-20 rounded shadow cursor-pointer
                                    {{!optional(App\Models\Edition::current())->is_final_programme_released ? "bg-{$presentationType->colour}-200 hover:bg-{$presentationType->colour}-200 dark:bg-{$presentationType->colour}-400/50 dark:hover:bg-{$presentationType->colour}-400/70" : "bg-red-400 hover:bg-red-400 dark:bg-red-800/50 dark:hover:bg-red-800/50"}}">
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
                            <div class="pl-1 text-left text-sm rounded-sm text-gray-100">
                                All {{$presentationType->name}}s are scheduled.
                            </div>
                        @endif
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex overflow-x-auto w-full py-2.5 shadow-lg overflow-x-auto overflow-y-hidden">
        <table class="h-max min-w-max rounded-sm bg-waitt-dark/70 backdrop-blur-sm">
            <thead class="bg-waitt-dark/70 backdrop-blur-sm">
            <tr>
                <th class="w-32 p-4 text-center text-white rounded-tl-lg"></th>
                @foreach ($rooms as $room)
                    <th class="w-64 p-4 text-center text-waitt-pink border-gray-300 border-b border-b-waitt-cyan-400/80">{{$room->name}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody id="grid-body">
            <tr class="text-gray-100 h-max">
                <td class="text-gray-100 h-max align-top text-center border-gray-900">
                    <span class="pt-2">
                        {{Carbon::parse(\App\Models\DefaultPresentation::opening()->start)->format('H:i')}}
                    </span>
                </td>
                <td class="text-left border-r h-full border-gray-300 dark:border-gray-900 relative overflow-visible"
                    colspan="{{\App\Models\Room::all()->count()}}">
                    <livewire:schedule.default-presentation :type="'opening'"/>
                </td>
            </tr>
            @foreach($timeslots as $key => $timeslot)
                @php
                    $time = Carbon::parse($timeslot->start);
                    $isEven = $key % 2 == 0;
                @endphp
                <tr class="text-gray-900">
                    <td class="text-gray-100 h-max align-top text-center border-gray-300 dark:border-gray-900">{{$isEven ? Carbon::parse($timeslot->start)->format('H:i') : ''}}</td> @foreach ($rooms as $room)
                        <td class="text-left border-r border-b h-max border-slate-800 dark:border-gray-900 relative overflow-visible">
                            <livewire:schedule.cell wire:key="cell-r-{{ $room->id }}-t-{{$timeslot->id}}"
                                                    :timeslot="$timeslot" :room="$room"
                            />
                        </td>
                    @endforeach
                </tr>
            @endforeach
            <tr class="text-gray-100 h-max">
                <td class="text-gray-100 h-max align-top text-center border-gray-300 dark:border-gray-900">
                    <span class="pt-2">
                        {{Carbon::parse(\App\Models\DefaultPresentation::closing()->start)->format('H:i')}}
                    </span>
                </td>
                <td class="text-left border-r h-full border-gray-300 dark:border-gray-900 relative overflow-visible"
                    colspan="{{\App\Models\Room::all()->count()}}">
                    <livewire:schedule.default-presentation :type="'closing'"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/draggable.js') }}"></script>

</div>

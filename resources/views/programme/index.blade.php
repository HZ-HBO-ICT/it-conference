@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
    use App\Models\Edition;
    use Illuminate\Support\Facades\Auth;

    $roleColour = Auth::user() ? Auth::user()->roleColour : 'blue';
@endphp

<x-app-layout>
    <div class="relative bg-cover overflow-hidden min-h-screen">
        <h2 class="text-center text-waitt-yellow text-5xl font-extrabold py-12">
            Programme
        </h2>
        <div class="flex overflow-x-auto w-full py-2.5 shadow-lg overflow-x-auto overflow-y-hidden">
            <table class="h-max min-w-max bg-white rounded-sm">
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
                @foreach($presentationsBySlot as $key => $presentations)
                    @php
                        $isEven = $loop->index % 2 == 0;
                    @endphp
                    <tr class=" {{$isEven ? "border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-gray-100" : "dark:border-gray-700 dark:bg-gray-700"}} text-gray-700 dark:text-gray-100 h-max hover:bg-gray-50">
                        <td class="{{$isEven ? 'text-gray-400' : 'text-gray-600' }} h-max text-center border-r border-gray-300 dark:border-gray-900">{{Carbon::parse($key)->format('H:i')}}</td>
                        @foreach ($rooms as $room)
                            <td class="text-left border-r h-max border-gray-300 dark:border-gray-900 relative overflow-visible">
                                <div class="flex-none h-full w-full"
                                     style="height: {{ $height }}rem">
                                    <div class="flex flex-col">
                                        @foreach($presentations as $presentation)
                                            <div>
                                                @if($presentation->timeslot_id && $presentation->room_id == $room->id)
                                                   <x-programme.presentation :presentation="$presentation"/>
                                                @elseif($presentation->room_id == $room->id)
                                                    <x-programme.default-presentation :presentation="$presentation"/>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

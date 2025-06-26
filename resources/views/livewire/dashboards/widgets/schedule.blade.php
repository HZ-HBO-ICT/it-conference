<div class="bg-black/[var(--bg-opacity)] [--bg-opacity:60%] rounded-lg shadow-lg overflow-hidden">
    <div class="px-6 py-4 ">
        <div class="flex items-center justify-between">
            <div class="flex flex-col text-md">
                <span class="text-white font-semibold">Event schedule</span>
                <span class="text-gray-200 text-xs">{{ $edition->start_at->format('l jS \\of F Y ') }}</span>
            </div>

            <button class="text-yellow-200 bg-white/[var(--bg-opacity)] [--bg-opacity:5%] px-1 py-0.5 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>
        </div>
    </div>


    <div class="relative overflow-hidden pr-5 pb-5">
        <div class="flex">
            <!-- Time Column -->
            <div class="w-20">
                @foreach($timeslots as $slot)
                    <div class="h-15 flex items-start justify-end pr-2 pt-1">
                        <span class="text-xs text-gray-200 font-medium">{{ $slot['time'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="flex-1 relative border-y border-r rounded">
                <!-- Time Grid Lines -->
                @foreach($timeslots as $index => $slot)
                    <div
                        class="h-15 border-y border-gray-100/50 transition-colors duration-150"
                    >
                        <div class="h-1/2 border-b border-gray-50/50"></div>
                    </div>
                @endforeach
                <div class="absolute inset-0 pointer-events-none">
                    @foreach($presentations as $presentation)
                        @php
                            $position = $this->getPresentationPosition($presentation);
                        @endphp
                        <div
                            class="absolute left-2 right-2 bg-[#17E6C4]/[var(--bg-opacity)] [--bg-opacity:95%] text-black border-b "
                            style="top: {{ $position['top'] }}; height: {{ $position['height'] }}; z-index: 10;"
                        >
                            <div class="p-2 h-full flex flex-col justify-between">
                                <div>
                                    <h4 class="text-sm font-medium truncate">{{ $presentation->name }}</h4>
                                    @if($presentation->presentationType->duration >= 60)
                                        <p class="text-xs opacity-90"> {{ $presentation->room->name  }} </p>
                                        <p class="text-xs opacity-90">{{ $presentation->start_time->format('H:i') }} - {{ $presentation->end_time->format('H:i') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

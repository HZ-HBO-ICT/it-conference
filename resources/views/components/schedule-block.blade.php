<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: bg-crew-500 dark:bg-crew-600 bg-violet-500 dark:bg-violet-600 bg-partner-500 dark:bg-partner-600 bg-participant-500 -->

<div
    class="w-full rounded overflow-hidden bg-{{$colorName}}-400 hover:cursor-pointer hover:bg-gradient-to-r hover:from-{{$colorName}}-400 hover:to-{{$colorName}}-600 hover:transition-all hover:duration-300 hover:ease-in-out
    dark:bg-{{$colorName}}-500 dark:hover:bg-gradient-to-r dark:hover:from-{{$colorName}}-500 dark:hover:to-{{$colorName}}-800 dark:hover:transition-all dark:hover:duration-300 dark:hover:ease-in-out">
    <div class="px-3 py-1">
        <div class="font-bold text-white text-md">{{$presentation->name}}</div>
        <div class="text-sm mb-2 text-gray-100">
            {{$presentation->speakers_name}}
            @if($presentation->creator->company)
                - {{$presentation->creator->company->name}}
            @endif
        </div>
        <p class="text-gray-100 text-sm">
            {{substr($presentation->description, 0, 55) . '...' }}
        </p>
    </div>
    <div class="px-2 pb-2">
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            {{$presentation->room->name}}
        </span>
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            Participants: {{$presentation->participants->count()}}/{{$presentation->room->max_participants}}
        </span>
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            {{ucfirst($presentation->difficulty->level)}}
        </span>
    </div>
</div>

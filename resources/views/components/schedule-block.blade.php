<!-- Leave this to fool Tailwind compilation, otherwise it will delete dynamic styles. There is a better fix! -->
<!-- Potential dynamic classes: text-crew-400 text-participant-400 text-partner-400 stroke-crew-400 stroke-participant-400 stroke-partner-400 -->
<!-- dark:text-crew dark:text-participant dark:text-partner hover:text-crew hover:text-participant hover:text-partner dark:hover:text-crew dark:hover:text-participant dark:hover:text-partner-->

<div
    class="w-full rounded overflow-hidden shadow-lg bg-{{$roleColour}}-400 transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
    <div class="px-3 py-1">
        <div class="font-bold text-white text-md">{{$presentation->name}}</div>
        <div class="text-sm mb-2 text-gray-100">{{$presentation->mainSpeaker()->user->name}}
            @if($presentation->mainSpeaker()->user->allTeams()->count() > 0)
                - {{$presentation->mainSpeaker()->user->currentTeam->name}}
            @endif
        </div>
        <p class="text-gray-100 text-sm">
            {{substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis
            eaque, exercitationem praesentium nihil.', 0, 55) . '...' }}
        </p>
    </div>
    <div class="px-2 pb-2">
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            {{$presentation->room->name}}
        </span>
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            Participants: {{$presentation->participants->count()}}/{{$presentation->maxParticipants()}}
        </span>
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            {{ucfirst($presentation->difficulty->level)}}
        </span>
    </div>
</div>

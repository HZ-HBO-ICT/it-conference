<div
    class="w-full rounded overflow-hidden shadow-lg bg-indigo-900 transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
    <div class="px-3 py-1">
        <div class="font-bold text-md">{{$presentation->name}}</div>
        <div class="text-sm mb-2">{{$presentation->mainSpeaker()->user->name}}
            @if($presentation->mainSpeaker()->user->allTeams()->count() > 0)
                - {{$presentation->mainSpeaker()->user->currentTeam->name}}
            @endif
        </div>
        <p class="text-gray-300 text-sm">
            {{substr('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis
            eaque, exercitationem praesentium nihil.', 0, 55) . '...' }}
        </p>
    </div>
    <div class="px-2 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">difficulty</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            {{$presentation->room->name}}
        </span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            Max participants: {{$presentation->maxParticipants()}}
        </span>
    </div>
</div>

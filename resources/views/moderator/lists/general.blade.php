<x-content-moderator-layout>
    <h1 class="text-4xl font-extrabold text-gray-700 dark:text-white ml-4 py-5">List of {{$type}}</h1>
    <div class="grid grid-cols-1 gap-2 pr-12 pl-4">
        @forelse($list as $item)
            @if($type === 'booths')
                <div
                    class="card w-full rounded-md bg-violet-700 text-white font-bold px-4 py-4 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
                    {{$item->team->name}}
                </div>
            @elseif($type === 'users' || $type === 'speakers' || $type === 'participants')
                <div
                    class="card w-full rounded-md bg-violet-700 text-white font-bold px-4 py-4 mb-2 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
                    {{$item->name}} - {{$item->email}}
                    <span class="text-xs mb-1 block">Role: {{implode(', ', $item->getRoleNames()->ToArray())}}</span>
                </div>
            @elseif($type === 'teams')
                <div
                    class="card w-full rounded-md bg-violet-700 text-white font-bold px-4 py-4 mb-2 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
                    {{$item->name}}
                    <span class="text-xs mb-1 block">Company representative: {{$item->owner->name}}</span>
                </div>
            @elseif($type === 'presentations')
                <div
                    class="card w-full rounded-md bg-violet-700 text-white font-bold px-4 py-4 mb-2 drop-shadow-l  transition-all duration-300 transform hover:scale-105 hover:cursor-pointer">
                    {{$item->name}}
                    <span class="text-xs mb-1 block">Speaker: {{$item->mainSpeaker()->user->name}}</span>
                </div>
            @endif
        @empty
            <p class="text-violet-600 text-lg">There are currently no {{$type}}.</p>
        @endforelse
    </div>
</x-content-moderator-layout>

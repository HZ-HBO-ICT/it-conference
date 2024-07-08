<x-app-layout>
    <div class="flex justify-center mt-10 p-8 mx-80 bg-white rounded-md dark:bg-slate-900">
        @if(!$speakers->isEmpty())
            <ul class="gap-y-8 max-w-none mx-0 grid-cols-3 gap-20 grid" role="list">
                @foreach($speakers as $speaker)
                    <li>
                        <div class="object-cover rounded-2xl w-full h-auto aspect-3/2 block place-content-center">
                            <img class="w-36 h-36 rounded-full mx-auto my-auto max-w-full" src="{{$speaker->user->profile_photo_url}}" alt="Profile picture of {{$speaker->user->name}}">
                        </div>
                        <h3 class="font-semibold text-xl leading-8 mt-6 dark:text-white">{{$speaker->user->name}}</h3>
                        @if($speaker->user->company)
                            <h3 class="leading-7 text-base m-0 text-gray-600 dark:text-slate-200">{{$speaker->user->company->name}}</h3>
                        @endif
                        <p class="leading-7 text-base mt-4 text-gray-600 dark:text-slate-200">{{$speaker->presentation->description}}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center text-2xl dark:text-white">There are no speakers available now.</p>
        @endif
    </div>
{{--  @TODO: Remove this div when footer is not as sticky anymore  --}}
    <div class="h-20"></div>
</x-app-layout>

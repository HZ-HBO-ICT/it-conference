@php
    $borderColor = 'bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400';
    $linkColor = 'text-pink-400 hover:text-pink-600';
@endphp

<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <h2 class="text-center text-gray-900 dark:text-gray-50 text-5xl font-extrabold bg-clip-text bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 mb-12">
            Our Speakers
        </h2>
        @if(!$speakers->isEmpty())
            @if($edition->keynote_name)
                <div
                    class="relative mb-12 min-h-full bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden transform transition-all">
                    <div class="absolute top-0 left-0 w-full h-2 {{$borderColor}}"></div>
                    <div class="p-8 grid grid-cols-1 lg:grid-cols-4">
                        <div class="col-span-1 h-full flex items-center justify-center">
                            <div class="relative w-40 h-40 md:w-64 md:h-64">
                                <div class="absolute inset-0 rounded-full opacity-75 blur-lg"></div>
                                <img class="relative w-40 h-40 md:w-64 md:h-64 rounded-full object-cover border-4 border-white"
                                     src="{{ $edition->keynote_picture_source }}"
                                     alt="Profile picture of {{$edition->keynote_name}}">
                            </div>
                        </div>
                        <div class="col-span-1 lg:col-span-3 flex flex-col justify-center ml-0 mt-2 md:mt-0 md:ml-8 text-center md:text-left">
                            <h3 class="font-bold text-2xl text-gray-900 dark:text-white">Keynote Speaker - {{$edition->keynote_name}}</h3>
                            <p class="mt-4 text-gray-600 dark:text-gray-400">{{strlen($edition->keynote_description) > 700 ? substr($edition->keynote_description, 0, 700) . '...' : $edition->keynote_description}}</p>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-2 {{$borderColor}}"></div>
                </div>
            @endif
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($speakers as $speaker)
                    @php
                        if ($speaker->user->company && $speaker->user->company->is_sponsorship_approved) {
                            switch ($speaker->user->company->sponsorship_id) {
                                case 1:
                                    $borderColor = 'bg-gradient-to-r from-yellow-300 to-yellow-600'; // Gold
                                    $linkColor = 'text-yellow-400 hover:text-yellow-500';
                                    break;
                                case 2:
                                    $borderColor = 'bg-gradient-to-r from-gray-300 to-gray-600'; // Silver
                                    $linkColor = 'text-gray-600 hover:text-gray-700';
                                    break;
                                case 3:
                                    $borderColor = 'bg-gradient-to-r from-orange-300 to-orange-600'; // Bronze
                                    $linkColor = 'text-orange-400 hover:text-orange-500';
                                    break;
                            }
                        } else {
                            $borderColor = 'bg-gradient-to-r from-blue-300 via-blue-400 to-blue-500'; // Default
                            $linkColor = 'text-blue-400 hover:text-blue-600';
                        }
                    @endphp
                    <a href="{{route('programme.presentation.show', $speaker->presentation)}}" class="{{$linkColor}}">
                        <div
                            class="relative min-h-full bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden transform transition-all hover:bg-gray-100 dark:hover:bg-gray-900">
                            <div class="absolute top-0 left-0 w-full h-2 {{$borderColor}}"></div>
                            <div class="p-8 flex flex-col items-center">
                                <div class="relative w-32 h-32 mb-6">
                                    <div class="absolute inset-0 rounded-full opacity-75 blur-lg"></div>
                                    <img class="relative w-32 h-32 rounded-full object-cover border-4 border-white"
                                         src="{{$speaker->user->profile_photo_url}}"
                                         alt="Profile picture of {{$speaker->user->name}}">
                                </div>
                                <h3 class="font-bold text-2xl text-gray-900 dark:text-white text-center">{{$speaker->user->name}}</h3>
                                @if($speaker->user->company)
                                    <p class="text-gray-600 dark:text-gray-400 text-center">{{$speaker->user->company->name}}</p>
                                @endif
                                <p class="mt-4 text-gray-600 dark:text-gray-400 text-center">{{strlen($speaker->presentation->description) > 165 ? substr($speaker->presentation->description, 0, 165) . '...' : $speaker->presentation->description}}</p>
                                <div class="mt-6">
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full h-2 {{$borderColor}}"></div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded py-2">
                <p class="text-center text-2xl font-bold">
                    There are no speakers available now.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>

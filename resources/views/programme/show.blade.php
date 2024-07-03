@php
    use Carbon\Carbon;

    $firstSpeaker = $presentation->first_speaker;
@endphp

<x-app-layout>
    <div class="relative bg-cover overflow-hidden min-h-screen">
        <div
            class="isolate px-6 py-6 max-w-7xl mx-auto mt-5 border border-gray-100 rounded bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="text-center max-w-2xl mx-auto mb-5">
                <h2 class="tracking-tight leading-10 font-bold text-2xl dark:text-white">Programme /
                    {{$presentation->type == 'workshop' ? 'Workshops' : 'Lectures'}}
                </h2>
            </div>
            <div class="mx-auto max-w-7xl">
                <div class="pt-3 px-6 pb-6 rounded-lg overflow-hidden relative">
                    <div
                        class="rounded-2xl py-3 px-3 border-2 shadow dark:bg-gray-800 border-gray-200 dark:border-gray-500">
                        <div class="py-5">
                            <h3 class="tracking-tight text-3xl font-semibold text-violet-700 text-center">{{$presentation->name}}</h3>
                        </div>
                        <div class="grid grid-cols-3 pt-5 px-6 pb-5 text-gray-900 dark:text-gray-200">
                            <div>
                                @if($presentation->speakers->count() > 1)
                                    <h4 class="tracking-tight text-xl font-semibold pb-5 pl-5 text-left">Speakers</h4>
                                @else
                                    <h4 class="tracking-tight text-xl font-semibold pb-5 pl-5 text-left">Speaker</h4>
                                @endif
                                <div class="grid grid-cols-3">
                                    @foreach($presentation->speakers as $speaker)
                                        <div class="flex justify-end">
                                            <div class="justify-self-end pr-3">
                                                <img
                                                    class="object-scale-down w-24 h-24 p-2 rounded-full border-gray-200 dark:border-gray-500 max-w-full block dark:text-white"
                                                    src="{{ $speaker->profile_photo_path . ('&size=240') }}"
                                                    alt="blq">
                                            </div>
                                        </div>
                                        <div
                                            class="col-span-2 sm:col-span-2 flex items-center tracking-tight text-lg font-semibold">{{$speaker->name}}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="sm:col-span-2 dark:text-white">
                                <div>
                                    <h3 class="tracking-tight text-xl font-semibold text-left">
                                        About the presentation
                                    </h3>
                                    <p>{{$presentation->description}}</p>
                                </div>
                                <div>
                                    <h3 class="tracking-tight text-xl font-semibold mt-6 text-left">
                                        Type of presentation
                                    </h3>
                                    <p>{{ucfirst($presentation->type)}}</p>
                                </div>
                                <div>
                                    <h3 class="tracking-tight text-xl font-semibold mt-6 text-left">
                                        Difficulty level
                                    </h3>
                                    <div
                                        class="text-yellow-500 flex transititext-primary text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                                        data-te-toggle="tooltip"
                                        title="{{ ucfirst($presentation->difficulty->description) }}">
                                        @for($i = 0; $i < $presentation->difficulty->id; $i++)
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                            </svg>
                                        @endfor
                                        <p class="text-gray-900 dark:text-gray-200"> - {{ucfirst($presentation->difficulty->level)}}</p>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="tracking-tight text-xl font-semibold mt-6 text-left">
                                        Place and time
                                    </h3>
                                    <p>Room: {{$presentation->room->name}}</p>
                                    <p>Time: {{Carbon::parse($presentation->timeslot->start)->format('H:i')}}
                                        - {{(Carbon::parse($presentation->timeslot->start)->addMinutes($presentation->timeslot->duration))->format('H:i')}}</p>
                                </div>
                                @if(Auth::user())
                                    @can('enroll', $presentation)
                                        <div class="pt-5">
                                            <form action="{{route('my.programme.enroll', $presentation)}}"
                                                  method="POST">
                                                @csrf
                                                <button class="bg-violet-500 hover:bg-violet-700 transition-all text-lg px-48 py-1 rounded-lg text-white">
                                                    Sign up
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        @if(Auth::user()->participating_in->contains($presentation))
                                            <div class="pt-5">
                                                <form action="{{route('my.programme.disenroll', $presentation)}}"
                                                      method="POST">
                                                    @csrf
                                                    <button class="bg-red-500 hover:bg-red-700 transition-all text-lg px-24 py-1 rounded-lg text-white">
                                                        Deregister from presentation
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif(!Auth::user()->presenter_of || (Auth::user()->presenter_of && !Auth::user()->isPresenterOf($presentation)))
                                            <div class="pt-5" data-te-toggle="tooltip" title="You cannot sign up because you are already busy during this time.">
                                                <button class="bg-gray-500 cursor-default transition-all text-lg px-48 py-1 rounded-lg text-white">
                                                    Sign up
                                                </button>
                                            </div>
                                        @endif
                                    @endcan
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@php
    use Carbon\Carbon;
    use App\Models\Edition;
@endphp

<x-app-layout>
    <div class="container h-screen mx-auto px-6 py-12">
        <h2 class="text-center {{"text-{$presentation->presentationType->colour}-300"}} text-4xl font-extrabold bg-clip-text bg-linear-to-r from-pink-400 via-purple-400 to-blue-400 mb-12">
            Programme / <span class=" font-bold text-waitt-yellow">{{$presentation->name}}</span>
        </h2>
        <div
            class="bg-waitt-dark backdrop-blur-sm border border-slate-900 rounded-2xl p-8 shadow-xl overflow-hidden transform transition-all">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-{{$presentation->presentationType->colour}}-300 via-{{$presentation->presentationType->colour}}-400 to-{{$presentation->presentationType->colour}}-500"></div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-5 px-6 pb-5">
                <div class="{{"text-{$presentation->presentationType->colour}-300"}}">
                    @if($presentation->speakers->count() > 1)
                        <h4 class="tracking-tight text-2xl font-bold pb-5 text-left">Speakers</h4>
                    @else
                        <h4 class="tracking-tight text-2xl font-bold pb-5 text-left">Speaker</h4>
                    @endif
                    <div class="grid grid-cols-3">
                        @foreach($presentation->speakers as $speaker)
                            <div class="hidden md:flex justify-end pr-3">
                                <img class="relative w-24 h-24 rounded-full object-cover border-4 border-white"
                                     src="{{ $speaker->profile_photo_url }}"
                                     alt="Profile picture of {{ $speaker->name }}">
                            </div>
                            <div
                                class="col-span-2 sm:col-span-2 flex items-center tracking-tight text-lg font-semibold">{{$speaker->name}}</div>
                        @endforeach
                    </div>
                </div>
                <div class="sm:col-span-2 text-white">
                    <h2 class="text-3xl {{"text-{$presentation->presentationType->colour}-300"}} font-bold mb-5">{{$presentation->name}}</h2>

                    <div>
                        <h2 class="text-2xl font-bold">About the presentation</h2>
                        <p class="leading-relaxed">{{$presentation->description}}</p>
                    </div>

                    <div class="grid grid-cols-2">
                        @if($presentation->company)
                            <div class="mt-5">
                                <h2 class="text-2xl font-bold">Company</h2>
                                <a class="font-bold"
                                   href="{{route('companies.show', $presentation->company)}}">{{$presentation->company->name}}</a>
                            </div>
                        @endif

                        <div class="mt-5">
                            <h2 class="text-2xl font-bold">Type of presentation</h2>
                            <p class="leading-relaxed">{{ucfirst($presentation->type)}}</p>
                        </div>

                        <div class="mt-5">
                            <h2 class="text-2xl font-bold">Available Places</h2>
                            <p class="leading-relaxed">{{ $presentation->remaining_capacity }} seats remaining</p>
                        </div>

                        <div class="mt-5">
                            <h2 class="text-2xl font-bold">
                                Difficulty level
                            </h2>
                            <div
                                class="text-white flex transititext-primary text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                                data-te-toggle="tooltip"
                                title="{{ ucfirst($presentation->difficulty->description) }}">
                                @for($i = 0; $i < $presentation->difficulty->id; $i++)
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                                    </svg>
                                @endfor
                                <p class="text-white">
                                    - {{ucfirst($presentation->difficulty->level)}}</p>

                            </div>
                        </div>
                    </div>
                    @if(optional(Edition::current())->is_final_programme_released)
                        <div class="mt-5">
                            <h2 class="text-2xl font-bold">
                                Place and time
                            </h2>
                            <p>Room: {{$presentation->room->name}}</p>
                            <p>Time: {{Carbon::parse($presentation->start)->format('H:i')}}
                               - {{(Carbon::parse($presentation->start)->addMinutes($presentation->duration))->format('H:i')}}</p>
                        </div>
                        @if(Auth::user())
                            @can('enroll', $presentation)
                                <div class="pt-5">
                                    <form action="{{route('my.programme.enroll', $presentation)}}"
                                          method="POST">
                                        @csrf
                                        <button
                                            class="bg-{{$presentation->presentationType->colour}}-400 hover:bg-{{$presentation->presentationType->colour}}-700 hover:cursor-pointer transition-all text-lg px-6 md:px-48 py-1 rounded-lg text-white w-full md:w-auto text-center">
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
                                            <button
                                                class="bg-red-500 hover:bg-red-700 transition-all text-lg px-6 md:px-24 py-1 rounded-lg text-white w-full md:w-auto text-center">
                                                Deregister from presentation
                                            </button>
                                        </form>
                                    </div>
                                @elseif(!Auth::user()->presenter_of || (Auth::user()->presenter_of && !Auth::user()->isPresenterOf($presentation)))
                                    <div class="pt-5" data-te-toggle="tooltip"
                                         title="You cannot sign up because you are already busy during this time.">
                                        <button
                                            class="bg-gray-500 cursor-default transition-all text-lg px-6 md:px-48 py-1 rounded-lg text-white w-full md:w-auto text-center">
                                            Sign up
                                        </button>
                                    </div>
                                @endif
                            @endcan
                        @endif
                    @endif
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-2 w-full h-2 bg-gradient-to-r from-{{$presentation->presentationType->colour}}-300 via-{{$presentation->presentationType->colour}}-400 to-{{$presentation->presentationType->colour}}-500"></div>
        </div>
    </div>
</x-app-layout>


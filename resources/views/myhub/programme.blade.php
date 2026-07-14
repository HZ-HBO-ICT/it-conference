@php
    use Carbon\Carbon;
    use App\Models\DefaultPresentation;
    use App\Models\Edition;
@endphp

<x-hub-layout>
    <div>
        <div class="py-8 px-8 mx-auto max-w-7xl">
            <div>
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold text-3xl text-gray-50 leading-tight">
                        {{ __('My Programme') }}
                    </h2>

                    <x-waitt.button-link href="{{ route('programme') }}">
                        {{ __('Sign up for presentations') }}
                    </x-waitt.button-link>
                </div>
            </div>
            <div>
                <div class="grid grid-cols-7 sm:gap-3 pt-10">
                    <!-- Start of the opening -->
                    <div class="sm:col-span-1">
                        <div class="text-left text-md text-white align-top">
                            {{Carbon::parse(DefaultPresentation::opening()->start)->format('H:i')}}
                            - {{Carbon::parse(DefaultPresentation::opening()->end)->format('H:i')}}
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <div
                            class="w-full rounded-sm overflow-hidden bg-waitt-dark/70 backdrop-blur-sm border border-waitt-yellow hover:transition-all hover:duration-300 hover:ease-in-out">
                            <div class="px-3 pb-1 pt-2">
                                <div
                                    class="font-bold text-white text-md">{{DefaultPresentation::opening()->name}}</div>
                                <p class="text-gray-100 text-sm">
                                    {{DefaultPresentation::opening()->description}}
                                </p>
                            </div>
                            <div class="px-2 pb-2">
                            <span class="inline-block bg-slate-950/40  border border-slate-950 text-gray-100 rounded-full px-3 py-1 text-xs font-semibold mr-2 mb-2">
                                {{DefaultPresentation::opening()->room->name}}
                            </span>
                            </div>
                        </div>
                    </div>
                    @foreach($presentations as $presentation)
                        <div class="sm:col-span-1">
                            <div class="text-left text-md text-white align-top">
                                {{Carbon::parse($presentation->start)->format('H:i')}}
                                - {{(Carbon::parse($presentation->start)->addMinutes($presentation->presentationType->duration))->format('H:i')}}
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <a href="{{route('programme.presentation.show', $presentation)}}">
                                <x-schedule-block :presentation="$presentation" :colorName="Auth::user()->roleColour"/>
                            </a>
                        </div>
                    @endforeach
                    <div class="sm:col-span-1">
                        <div class="text-left text-md text-white align-top">
                            {{Carbon::parse(DefaultPresentation::closing()->start)->format('H:i')}}
                            - {{Carbon::parse(DefaultPresentation::closing()->end)->format('H:i')}}
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <div
                            class="w-full rounded-sm overflow-hidden backdrop-blur-sm border border-waitt-yellow hover:transition-all hover:duration-300 hover:ease-in-out">
                            <div class="px-3 pb-1 pt-2">
                                <div
                                    class="font-bold text-white text-md">{{DefaultPresentation::closing()->name}}</div>
                                <p class="text-gray-100 text-sm">
                                    {{DefaultPresentation::closing()->description}}
                                </p>
                            </div>
                            <div class="px-3 pb-1 pt-2">
                            <span class="inline-block bg-slate-950/40  border border-slate-950 text-gray-100 rounded-full px-3 py-1 text-xs font-semibold mr-2 mb-2">
                                {{DefaultPresentation::closing()->room->name}}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-hub-layout>

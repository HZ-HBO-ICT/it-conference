@php use Carbon\Carbon; @endphp
<a href="{{route('programme.presentation.show', $presentation)}}">
    <div class=" w-full pt-0.5 px-2"
         style="height: {{ $presentation->calculateHeightInREM() }}rem;">
        <div
            class="w-full h-full rounded-sm {{"bg-{$presentation->presentationType->colour}-300"}}"
            style="margin-top: {{$presentation->calculateMarginTopInREM()}}rem;"
        >
            <div class="flex h-full w-full overflow-hidden">
                <div class="flex relative flex-col text-center items-center justify-center w-full px-2">

                    @auth()
                        @if(Auth::user()->participating_in->contains($presentation))
                            <div class="absolute top-0 right-0 text-center bg-waitt-cyan"
                                 style="padding: 0 2em;
                                 transform: translateY(-50%) rotate(90deg) translateX(50%) rotate(-45deg);
                                 transform-origin: bottom right">
                                <div>in!</div>
                            </div>
                        @endif
                    @endauth

                <span class="text-sm font-semibold">
                    {{ $presentation->displayName(50, false)  }}
                </span>
                    <span class="text-xs">
                    {{
                        Carbon::parse($presentation->start)->format('H:i')
                        . '-'
                        . Carbon::parse($presentation->start)->addMinutes($presentation->duration)->format('H:i')
                    }}
                </span>
                </div>

            </div>
        </div>
    </div>
</a>

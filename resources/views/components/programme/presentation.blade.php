@php use Carbon\Carbon; @endphp
<div class="absolute w-full pt-0.5 px-2"
     style="height: {{ $presentation->calculateHeightInREM() }}rem;">
    <div
        class="w-full h-full rounded-sm {{"bg-{$presentation->presentationType->colour}-300"}}"
        style="margin-top: {{$presentation->calculateMarginTopInREM()}}rem;"
    >
        <div class="flex h-full w-full overflow-hidden">
            <div class="flex flex-col text-center items-center justify-center w-full px-2">
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

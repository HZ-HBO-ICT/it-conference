@php use Carbon\Carbon; @endphp
<div class="absolute w-full pt-0.5 px-2"
     style="height: {{ Carbon::parse($presentation->start)->diffInMinutes(Carbon::parse($presentation->end)) * (14 / 30) * 0.25}}rem;">
    <div
        class="w-full h-full rounded-sm bg-waitt-yellow"
    >
        <div class="flex h-full overflow-hidden">
            <div class="flex flex-col text-center items-center justify-center w-full">
                <span class="text-sm font-semibold">
                    {{ $presentation->name }}
                </span>
                <span class="text-xs">
                {{
                    Carbon::parse($presentation->start)->format('H:i')
                    . '-'
                    . Carbon::parse($presentation->end)->format('H:i')
                }}
                </span>
            </div>
        </div>
    </div>
</div>

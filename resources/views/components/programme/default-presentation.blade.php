@php use Carbon\Carbon; @endphp
<div class=" w-full pt-0.5 px-2"
     style="height: {{ Carbon::parse($presentation->start)->diffInMinutes(Carbon::parse($presentation->end)) * (14 / 30) * 0.25}}rem;">
    <div
        class="w-full h-full rounded-sm bg-waitt-yellow max-md:h-3/4 max-md:bg-waitt-dark/70 max-md:rounded-xl max-md:shadow max-md:border max-md:border-waitt-yellow max-md:text-waitt-yellow"
    >
        <div class="flex h-full overflow-hidden">
            <div class="flex relative flex-col text-center items-center justify-center w-full">
                <div class=" absolute text-waitt-dark/70 top-0 right-0 text-center bg-green-500"
                     style="padding: 0 2em;
                             transform:translateY(-300%) rotate(90deg) translateX(105%) rotate(-45deg);
                             transform-origin: bottom right"
                >
                    <div>Enrolled!</div>
                </div>
                <span class="font-semibold">
                    {{ $presentation->name }}
                </span>
                <span class="md:hidden text-md font-bold">
                    GW027
                </span>
                <span class="text-xs max-md:text-white">
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

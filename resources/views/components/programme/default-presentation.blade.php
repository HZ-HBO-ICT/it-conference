@php use Carbon\Carbon; @endphp
<div class="w-full py-3">
    <div
        class="w-full h-full rounded-sm bg-waitt-yellow max-md:h-3/4 max-md:bg-waitt-dark/70 max-md:rounded-xl max-md:shadow max-md:border max-md:border-waitt-yellow max-md:text-waitt-yellow"
    >
        <div class="flex h-full overflow-hidden">
            <div class="flex relative flex-col text-center items-center justify-center w-full">
                <div class="absolute top-0 right-0 text-center bg-waitt-cyan text-black"
                     style="padding: 0 2em;
                     transform: translateY(-50%) rotate(90deg) translateX(50%) rotate(-45deg);
                     transform-origin: bottom right">
                    <div>in!</div>
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

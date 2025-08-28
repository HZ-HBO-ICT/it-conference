@php use Carbon\Carbon; @endphp
<div
    class="cursor-move w-5/6 rounded-sm bg-opacity-50 absolute"
    style="height: {{ Carbon::parse($presentation->start)->diffInMinutes(Carbon::parse($presentation->end)) * (14 / 30) * 0.25}}rem;"
>
    <div class="flex h-full overflow-hidden">
        <div class="w-2 rounded-tl rounded-bl"></div>
        <div class="flex flex-col pt-1 pb-2 ml-2">
            <span>
                 {{ $presentation->name  }}
            </span>
        </div>
    </div>
</div>

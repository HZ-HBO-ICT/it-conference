<div
    class="cursor-move w-5/6 rounded-sm bg-opacity-50 absolute {{"bg-{$presentation->getColors()}-300"}}"
    style="height: {{ $presentation->calculateHeightInREM() }}rem; margin-top: {{$presentation->calculateMarginTopInREM()}}rem;"
>
    <div class="flex h-full overflow-hidden">
        <div class="w-2 rounded-tl rounded-bl {{"bg-{$presentation->presentationType->colour}-300"}}"></div>
        <div class="flex flex-col pt-1 pb-2 ml-2">
                                                    <span>
                                                        {{ $presentation->displayName(20)  }}
                                                    </span>
            <span class="text-xs">
                {{ strlen($presentation->speakersName) > 29 ? substr($presentation->speakersName, 0, 29) . '...' : $presentation->speakersName }}
            </span>
            @if($presentation->company)
                <span class="text-xs">
                    {{ strlen($presentation->company->name) > 29 ? substr($presentation->company->name, 0, 29) . '...' : $presentation->company->name }}
                </span>
            @endif
        </div>
    </div>
</div>
